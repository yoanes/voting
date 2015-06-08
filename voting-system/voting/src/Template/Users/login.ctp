
<div class="contestants form large-10 medium-9 columns">
    <?= $this->Form->create(null, [
          'url' => '/users/login',
          'type' => 'post'
    ]) ?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Login')) ?>
    <?= $this->Form->end() ?>
</div>
