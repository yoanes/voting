<div>
<?php if(isset($contestants)) { ?>
    <h6>You have <?= $vote->remaining_vote ?> vote(s) remaining for this ticket</h6>
    <?= $this->Form->create() ?>
    <ul>
    <?php foreach($contestants as $c): ?>
       <li>
          <?= $c->name ?>
          <input type="number" name="contestant[<?= $c->id ?>]" min="0"/>
       </li>
    <?php endforeach; ?>
    </ul>
    <?= $this->Form->button(__('Vote')) ?>
    <?= $this->Form->end() ?>
<?php } ?>


