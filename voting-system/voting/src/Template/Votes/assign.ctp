<div>
<?php if(isset($contestants)) { ?>
    <h6>You have <?= $vote->remaining_vote ?> vote(s) remaining for this ticket</h6>
    <?= $this->Form->create() ?>
    <ul>
    <?php foreach($contestants as $index => $c): ?>
       <li>
          <fieldset>
          <label for="contestant<?= $index ?>"><?= $c->name ?></label>
          <input type="number" id="contestant<?= $index ?>" name="contestant[<?= $c->id ?>]" min="0"/>
          </fieldset>
       </li>
    <?php endforeach; ?>
    </ul>
    <?= $this->Form->button(__('Vote')) ?>
    <?= $this->Form->end() ?>
<?php } ?>


