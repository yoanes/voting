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
                       <?= $c->name ?>
                    </h1>
                    <div>
                        <img src="<?= $c->avatar_url ?>" width="150px" />
                        <p style="float:right">
                            <label for="contestant<?= $index ?>">Your vote</label>
                            <input type="number" id="contestant<?= $index ?>" name="contestant[<?= $c->id ?>]" min="0" max="100" class="voteInput"/>
                        </p>
                    </div>
                    <p>
                        <a href="<?= $c->profile_url ?>">More about this contestant</a>
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

