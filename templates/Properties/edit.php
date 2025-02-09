<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property $property
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Of Properties'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Add New Property'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Delete Property'),
                ['action' => 'delete', $property->id],
                [
                    'confirm' => __('Are you sure you want to delete # {0}?', $property->id),
                    'style' => 'background-color: red; color: white; padding: 10px 15px; border: none; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 14px; text-align: center; cursor: pointer;',
                    'class' => 'side-nav-item'
                ]
            ) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="properties form content">
            <?= $this->Form->create($property, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Property') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('beds');
                    echo $this->Form->control('baths');
                    echo $this->Form->control('sqft');
                    echo $this->Form->control('price');
                   /* echo $this->Form->control('photo');*/
                // Display the current photo
                if (!empty($property->photo)) {
                    echo $this->Html->image($property->photo, ['alt' => 'Current Photo', 'style' => 'max-width: 300px; height: auto;']);
                    echo $this->Form->control('delete_photo', [
                                            'type' => 'checkbox',
                                            'label' => 'Delete this photo'
                    ]);

                }

                // Allow uploading a new photo
                echo $this->Form->control('image_file', ['type' => 'file', 'label' => 'Upload New Photo']);
                ?>
            </fieldset>

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
