<?php
namespace App\Model\Table;

use App\Model\Entity\Vote;
use ArrayObject;
use Cake\Event\Event;
use Cake\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Votes Model
 *
 */
class VotesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('votes');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('receipt', 'create')
            ->notEmpty('receipt');
            
        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');
            
        $validator
            ->add('assigned_vote', 'valid', ['rule' => 'numeric'])
            ->requirePresence('assigned_vote', 'create')
            ->notEmpty('assigned_vote');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['receipt'], 'Supplied receipt already exists'));
        return $rules;
    }

    public function beforeSave(Event $event, Entity $entity, ArrayObject $options) {
        if($entity->isNew()) {
            $entity->set('remaining_vote', $entity->get('assigned_vote'));
            $entity->set('guid', uniqid("vote.",true));
        }

        return true;
    }

    public function getByToken($token = null) {
        if(is_null($token) || $token == '') {
            return null;
        }

        $votes = TableRegistry::get('Votes');
        $query = $votes->find()->where(['guid' => $token]);
        $vote = $query->first();

        return $vote;
    }

    public function assignVote($contestantId, $assignedVote, Vote &$vote) {
        $conn = ConnectionManager::get('default');

        $conn->begin();
        $conn->execute('UPDATE contestants SET vote_count = vote_count + ? WHERE id = ?', [$assignedVote, $contestantId]);
        $conn->execute('UPDATE votes SET remaining_vote = remaining_vote - ? WHERE guid = ?', [ $assignedVote, $vote->guid]);
        $conn->execute('INSERT INTO contestants_votes (contestant_id, vote_id, vote_assigned, created) VALUES (?,?,?,?)',
            [$contestantId, $vote->id, $assignedVote, date("Y-m-d H:i:s")]);
        $conn->commit();

        $vote->updateRemainingVoteAfterAssignment($assignedVote);
    }
}