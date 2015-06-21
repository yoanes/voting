<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Contestants'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Votes'), ['controller' => 'Votes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vote'), ['controller' => 'Votes', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="contestants form large-10 medium-9 columns">
    <?= $this->Form->create($contestant) ?>
    <fieldset>
        <legend><?= __('Add Contestant') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('video_url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
