Topics Controller > Index Action

<table>
	<tr>
		<th>タイトル</th>
		<th>投稿者</th>
		<th>作成日</th>
		<th>最終更新</th>
		<th colspan="2">操作</th>
	</tr>

<?php foreach($topics as $row): ?>
	<tr>
		<td><?php echo $this->Html->link(h($row['Topic']['title']), '/Topics/view/'.$row['Topic']['id']) ?></td>
		<td><?php echo h($row['User']['username']) ?></td>
		<td><?php echo h($row['Topic']['created']) ?></td>
		<td><?php echo h($row['Topic']['modified']) ?></td>
		<td><?php echo $this->Html->link('編集', '/Topics/edit/'.$row['Topic']['id']) ?></td>
		<td><?php echo $this->Html->link('削除', '/Topics/delete/'.$row['Topic']['id']) ?></td>
	</tr>
<?php endforeach; ?>
</table>

