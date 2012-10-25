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
<p id="like_topic">
	<?php echo $this->Html->link('いいね！', array('controller' => 'Likes', 'action' => 'likeTopic/', $topic['id'])) ?></br >
	<?php foreach($like_topic as $like): ?>

	<?php echo h($like['User']['username']) ?>さん
	<?php endforeach; ?>
	</br >
	<?php echo count($like_topic) ?>人がこのトピックねいいね！といっています。
</p>

<?php foreach($comments as $row): ?>

	<div class="comment">
		<p class="body"><?php echo h($row['Comment']['body'])  ?></p>
		<p class="comment_data">
			<?php echo h($row['User']['username']) ?>（<?php echo h($row['Comment']['modified'])?>）
			<?php echo $this->Html->Link('編集', array('controller' => 'Comments', 'action' => 'edit/' . $row['Comment']['id'])) ?>
			<?php echo $this->Html->Link('削除', array('controller' => 'Comments', 'action' => 'delete/' . $row['Comment']['id'])) ?>
		</p>
		<p class="like_comment">
			<?php echo $this->Html->link('いいね！', array('controller' => 'Likes', 'action' => 'likeComment/', $row['Comment']['id'])) ?></br >
			<?php foreach($row['Like'] as $like): ?>
			<?php echo h($like['User']['username']) ?>さん
			<?php endforeach; ?>
			</br >
			<?php echo count($row['Like']) ?>人がこのコメントにいいね！といっています。
		</p>
	</div>

<?php endforeach; ?>


<?php
echo $this->Form->create('Comment', array('action' => 'create'));

echo $this->Form->textarea('Comment.body');
echo $this->Form->hidden('Comment.topic_id', array('value' => $topic['id']));

echo $this->Form->end('コメントを書き込む');
?>

