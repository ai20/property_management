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
            <?= $this->Html->link(__('Edit Property'), ['action' => 'edit', $property->id], ['class' => 'side-nav-item']) ?>
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
        <div class="properties view content">
            <h3><?= h($property->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($property->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Photo') ?></th>
                    <td>
                        <?php if (!empty($property->photo)): ?>
                            <?= $this->Html->image($property->photo, [
                                'alt' => 'Property Image',
                                'style' => 'max-width: 300px; height: auto;',
                            ]) ?>
                        <?php else: ?>
                            <?= __('No Image Available') ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($property->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Beds') ?></th>
                    <td><?= $this->Number->format($property->beds) ?></td>
                </tr>
                <tr>
                    <th><?= __('Baths') ?></th>
                    <td><?= $this->Number->format($property->baths) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sqft') ?></th>
                    <td><?= $this->Number->format($property->sqft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($property->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($property->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
