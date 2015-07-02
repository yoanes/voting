<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Contestant'), ['action' => 'edit', $contestant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contestant'), ['action' => 'delete', $contestant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contestant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contestants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contestant'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Votes'), ['controller' => 'Votes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vote'), ['controller' => 'Votes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="contestants view large-10 medium-9 columns">
    <h2><?= h($contestant->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($contestant->name) ?></p>
            <h6 class="subheader"><?= __('Video Url') ?></h6>
            <p><?= h($contestant->profile_url) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($contestant->id) ?></p>
            <h6 class="subheader"><?= __('Vote Count') ?></h6>
            <p><?= $this->Number->format($contestant->vote_count) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($contestant->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($contestant->modified) ?></p>
        </div>
    </div>
</div>