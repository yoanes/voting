<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contestant Entity.
 */
class Contestant extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'profile_url' => true,
        'vote_count' => true,
        'votes' => true,
    ];
}
