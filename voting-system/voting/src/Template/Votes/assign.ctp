<div>
<?php if(isset($contestants)) { ?>
    <?= $this->Form->create() ?>
    <div class="col-md-9">
        <div id="post-10" class="post-10 page type-page status-publish hentry">
            <div class="post-page">
                <h1 class="post-page-head" >
                   You have <?= $vote->remaining_vote ?> vote(s) remaining for this ticket
                </h1>
                <p>
                   <?= $this->Form->button(__('Submit Vote'), array('class' => 'voteSubmit')) ?>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <?php foreach($contestants as $index => $c): ?>
        <div class="col-md-9">
            <div id="post-10" class="post-10 page type-page status-publish hentry">
                <div class="post-page">
                    <h1 class="post-page-head" style="padding-bottom:20px">
                        <label for="contestant<?= $index ?>"><?= $c->name ?></label>
                        <input type="number" id="contestant<?= $index ?>" name="contestant[<?= $c->id ?>]" min="0" max="100" class="voteInput"/>
                    </h1>
                    <p>
                       <iframe width="100%" height="315" src="<?= $c->profile_url ?>" frameborder="0" allowfullscreen></iframe>
                    </p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach; ?>

    <div class="col-md-9">
        <div id="post-10" class="post-10 page type-page status-publish hentry">
            <div class="post-page">
                <h1 class="post-page-head" >
                   You have <?= $vote->remaining_vote ?> vote(s) remaining for this ticket
                </h1>
                <p>
                   <?= $this->Form->button(__('Submit Vote'), array('class' => 'voteSubmit')) ?>
                </p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?= $this->Form->end() ?>
<?php } ?>

