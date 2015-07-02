<div>

<h3>You've used your vote for the following contestant(s): </h3>

<ul>
   <?php foreach($contestantsVote as $index => $c): ?>
      <li><?= $c[0] ?>: <?= $c[1] ?> vote(s)</li>
   <?php endforeach; ?>
</ul>

<h3>You have <?= $remainingVote ?> vote(s) left</h3>
<?php if($remainingVote > 0) { ?>
<p>Click <a href="/votes/assign/<?= $token ?>">here</a> to vote again.</p>
<?php } ?>
</div>