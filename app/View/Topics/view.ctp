Topic Controller > View Action
<hr>

<h2><?php echo h($topic['title']) ?></h2>
<p id="topic_data">
	トピック作成日：<?php echo h($topic['created']) ?></br >
	最終更新日：<?php echo h($topic['modified']) ?>
</p>

<p id="topic_body">
	投稿者：<?php echo h($username) ?></br >
	<?php echo h($topic['body']); ?>
</p>
