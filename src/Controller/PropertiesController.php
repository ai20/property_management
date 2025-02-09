<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Properties Controller
 *
 * @property \App\Model\Table\PropertiesTable $Properties
 */
class PropertiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $search = $this->request->getQuery('search'); // Get the search term from the query string

        $query = $this->Properties->find();

        // Apply search filter if a search term exists
        if (!empty($search)) {
            $query->where([
                'OR' => [
                    'Properties.title LIKE' => '%' . $search . '%',
                    'Properties.beds' => (int)$search,   // Exact match for numeric fields
                    'Properties.baths' => (int)$search,
                    'Properties.sqft' => (int)$search,
                    'Properties.price' => (int)$search,
                ]
            ]);
        }

        $this->paginate = [
            'limit' => 5,
            'order' => [
                'Properties.id' => 'asc'
            ]
        ];

        $properties = $this->paginate($query);

        $this->set(compact('properties', 'search')); // Pass the search term to the view
    }



    /**
     * View method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $property = $this->Properties->get($id, contain: []);
        $this->set(compact('property'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $property = $this->Properties->newEmptyEntity();

        if ($this->request->is('post')) {
            $property = $this->Properties->patchEntity($property, $this->request->getData());

            // Handle Image Upload
            $image = $this->request->getData('image_file'); // Uploaded file object
            if ($image instanceof \Psr\Http\Message\UploadedFileInterface && $image->getError() === 0) {
                // Generate a unique filename
                $imageName = time() . '_' . $image->getClientFilename();
                $uploadPath = WWW_ROOT . 'img' . DS . 'properties' . DS . $imageName;

                // Move the file to the target directory
                try {
                    $image->moveTo($uploadPath);
                    $property->photo  = 'properties/' . $imageName; // Save relative path to database
                } catch (\Exception $e) {
                    $this->Flash->error(__('File upload failed: ' . $e->getMessage()));
                }
            } elseif ($image && $image->getError() !== UPLOAD_ERR_NO_FILE){
                $this->Flash->error(__('No file uploaded or invalid file.'));
            }

            // Save the property to the database
            if ($this->Properties->save($property)) {
                $this->Flash->success(__('Property added successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Failed to add property.'));
        }

        $this->set(compact('property'));
    }



    /**
     * Edit method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit($id = null)
    {
        $property = $this->Properties->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Handle deleting the current photo
            if (!empty($this->request->getData('delete_photo')) && !empty($property->photo)) {
                $filePath = WWW_ROOT . 'img' . DS . $property->photo;
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete the file from the server
                }
                $property->photo  = null; // Remove reference from the database
            }

            // Handle new photo upload
            $image = $this->request->getData('image_file');
            if ($image instanceof \Psr\Http\Message\UploadedFileInterface && $image->getError() === 0) {
                $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientFilename());
                $uploadPath = WWW_ROOT . 'img' . DS . 'properties' . DS . $imageName;

                try {
                    $image->moveTo($uploadPath); // Move the file to the target directory

                    // Delete the old photo if a new one is uploaded
                    if (!empty($property->photo)) {
                        $oldFilePath = WWW_ROOT . 'img' . DS . $property->photo;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    $property->photo  = 'properties/' . $imageName; // Save the new image path
                } catch (\Exception $e) {
                    $this->Flash->error(__('File upload failed: ' . $e->getMessage()));
                }
            }

            // Patch and save the updated property data
            $property = $this->Properties->patchEntity($property, $this->request->getData());
            if ($this->Properties->save($property)) {
                $this->Flash->success(__('The property has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The property could not be saved. Please, try again.'));
        }

        $this->set(compact('property'));
    }



    /**
     * Delete method
     *
     * @param string|null $id Property id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $property = $this->Properties->get($id);

        // Delete the associated photo file, if it exists
        if (!empty($property->photo)) {
            $filePath = WWW_ROOT . 'img' . DS . $property->photo; // Build the full path to the image
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file
            }
        }

        // Delete the property record
        if ($this->Properties->delete($property)) {
            $this->Flash->success(__('The property and its photo have been deleted.'));
        } else {
            $this->Flash->error(__('The property could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
