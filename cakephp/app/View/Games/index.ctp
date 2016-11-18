<h1>狼人杀 你的金币：<?php echo $coins; ?></h1>

<h1> <?php 
     echo $this->Form->create(null,['url'=>['action'=>'addGame']]);
      echo $this->Form->end(__('开始一局新游戏'));?>
</h1>
<table>
	<tr>
		<th> 游戏场次 </th>
		<th>  </th>
	</tr>
	<?php foreach($allGames as $game): ?>
		<tr>
			<td><?php echo $game['Game']['id']?>
			<td><?php 
			echo $this->Form->create(null,['url'=>['controller'=>'GameInfos','action'=>'addRole','game_id'=>$game['Game']['id']],'type'=>'get']);
			echo $this->Form->end(__('加入游戏')); 
			?>
		</tr>
	<?php endforeach; ?>
</table>
<?php 
echo $this->Form->create(null,['url'=>['controller'=>'Games','action'=>'index']]);
echo $this->Form->end(__('刷新'));
?>
