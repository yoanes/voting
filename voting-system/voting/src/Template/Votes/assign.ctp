<div>
<?php if(isset($contestants)) { ?>
    <h6>You have <?= $vote->remaining_vote ?> vote(s) remaining for this ticket</h6>
    <?= $this->Form->create() ?>
    <ul>
    <?php foreach($contestants as $c): ?>
       <li>
          <?= $c->name ?>
          <input type="text" name="contestant[<?= $c->id ?>]"/>
       </li>
    <?php endforeach; ?>
    </ul>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<?php } ?>