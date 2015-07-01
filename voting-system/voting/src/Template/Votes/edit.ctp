<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Votes'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="votes form large-10 medium-9 columns">
    <?= $this->Form->create($vote) ?>
    <fieldset>
        <legend><?= __('Edit Vote') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('receipt', ['type' => 'text']);
            echo $this->Form->input('assigned_vote');
            echo $this->Form->input('remaining_vote');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
