<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Contestant'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Votes'), ['controller' => 'Votes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Vote'), ['controller' => 'Votes', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="contestants index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('profile_url') ?></th>
            <th><?= $this->Paginator->sort('vote_count') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($contestants as $contestant): ?>
        <tr>
            <td><?= $this->Number->format($contestant->id) ?></td>
            <td><?= h($contestant->name) ?></td>
            <td><?= h($contestant->profile_url) ?></td>
            <td><?= $this->Number->format($contestant->vote_count) ?></td>
            <td><?= h($contestant->created) ?></td>
            <td><?= h($contestant->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $contestant->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contestant->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contestant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contestant->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
