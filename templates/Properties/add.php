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
        </div>
    </aside>
    <div class="column column-80">
        <div class="properties form content">
            <?= $this->Form->create($property, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Property') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('beds');
                    echo $this->Form->control('baths');
                    echo $this->Form->control('sqft');
                    echo $this->Form->control('price');
                ?>
            </fieldset>
            <!-- File Upload Input -->
            <?= $this->Form->control('image_file', ['type' => 'file', 'label' => 'Upload Property Photo']) ?>

            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
