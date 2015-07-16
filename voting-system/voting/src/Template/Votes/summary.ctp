<div>

<?php if (count($contestantsVote) != 0) { ?>
     <div class="col-md-9">
        <div id="post-10" class="post-10 page type-page status-publish hentry">
            <div class="post-page">
                <h2>You have voted for the following contestant(s)</h2>
                <ul>
                   <?php foreach($contestantsVote as $index => $c): ?>
                      <li><?= $c[0] ?>: <?= $c[1] ?> vote(s)</li>
                   <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<?php } ?>

<div class="col-md-9">
    <div id="post-10" class="post-10 page type-page status-publish hentry">
        <div class="post-page">
            <h3>You have <?= $remainingVote ?> vote(s) left</h3>
            <?php if($remainingVote > 0) { ?>
                <p>Click <a href="/<?= $token ?>">here</a> to vote again.</p>
            <?php } ?>

        </div>
    </div>
<div class="clearfix"></div>
</div>