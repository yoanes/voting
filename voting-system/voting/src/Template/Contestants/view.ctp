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
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Votes') ?></h4>
    <?php if (!empty($contestant->votes)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Receipt Reference') ?></th>
            <th><?= __('Email') ?></th>
            <th><?= __('Assigned Vote') ?></th>
            <th><?= __('Remaining Vote') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($contestant->votes as $votes): ?>
        <tr>
            <td><?= h($votes->id) ?></td>
            <td><?= h($votes->receipt_reference) ?></td>
            <td><?= h($votes->email) ?></td>
            <td><?= h($votes->assigned_vote) ?></td>
            <td><?= h($votes->remaining_vote) ?></td>
            <td><?= h($votes->created) ?></td>
            <td><?= h($votes->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Votes', 'action' => 'view', $votes->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Votes', 'action' => 'edit', $votes->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Votes', 'action' => 'delete', $votes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $votes->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
