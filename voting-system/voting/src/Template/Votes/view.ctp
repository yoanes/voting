<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Resend Email'), ['action' => 'resendEmail', $vote->id]) ?> </li>
        <li><?= $this->Html->link(__('Edit Vote'), ['action' => 'edit', $vote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Vote'), ['action' => 'delete', $vote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Votes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vote'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="votes view large-10 medium-9 columns">
    <h2><?= h($vote->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Receipt') ?></h6>
            <p><?= h($vote->receipt) ?></p>
            <h6 class="subheader"><?= __('Email') ?></h6>
            <p><?= h($vote->email) ?></p>
            <h6 class="subheader"><?= __('Guid') ?></h6>
            <p><?= h($vote->guid) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($vote->id) ?></p>
            <h6 class="subheader"><?= __('Assigned Vote') ?></h6>
            <p><?= $this->Number->format($vote->assigned_vote) ?></p>
            <h6 class="subheader"><?= __('Remaining Vote') ?></h6>
            <p><?= $this->Number->format($vote->remaining_vote) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($vote->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($vote->modified) ?></p>
        </div>
    </div>
</div>
