<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vote Entity.
 */
class Vote extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'receipt' => true,
        'assigned_vote' => true
    ];

    public function hasEnoughToVote($toBeAssigned) {
        if($toBeAssigned > $this->remaining_vote) {
            return false;
        }
        return true;
    }

    public function updateRemainingVoteAfterAssignment($voteAssigned) {
        $this->remaining_vote -= $voteAssigned;
    }

    public function hasAnyVoteLeft() {
        return $this->remaining_vote > 0;
    }

    public function getRemainingVote() {
        return $this->remaining_vote;
    }

    public function getToken() {
        return $this->guid;
    }

    public function getEmail() {
        return $this->email;
    }
}
