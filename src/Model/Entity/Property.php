<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Property Entity
 *
 * @property int $id
 * @property string $title
 * @property int $beds
 * @property int $baths
 * @property int $sqft
 * @property string $price
 * @property string|null $photo
 * @property \Cake\I18n\DateTime|null $created
 */
class Property extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'title' => true,
        'beds' => true,
        'baths' => true,
        'sqft' => true,
        'price' => true,
        'photo' => true,
        'created' => true,
    ];
}
