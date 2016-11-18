<h1> 狼人杀  </h1>
<h1><?php echo "本局游戏"+$gameId; ?>
<?php 
echo $this->Form->create(null,['url'=>['controller'=>'GameInfos','action'=>'index','game_id'=>$gameId]]);
echo $this->Form->end(__('刷新'));
?>
<?php if($role == 0){ ?>
<table>
	<tr>
		<th>号码</th>
		<th>角色</th>
		<th>押注</th>
	</tr>
	<?php foreach ($allInfos as $info): ?>
		<tr>
			<td><?php echo $info['GameInfo']['number'] ?>

			<td><?php 
				$roleNumber=$info['GameInfo']['role'];
				if($roleNumber==0){
					echo "上帝";
				}
				if($roleNumber==1){
					echo "村民";
				}
				if($roleNumber==2){
					echo "狼人";
				}
				if($roleNumber==3){
					echo "白狼王";
				}
				if($roleNumber==4){
					echo "狼美人";
				}
				if($roleNumber==5){
					echo "预言家";
				}
				if($roleNumber==6){
					echo "女巫";
				}
				if($roleNumber==7){
					echo "守卫";
				}
				if($roleNumber==8){
					echo "猎人";
				}
				if($roleNumber==9){
					echo "白痴";
				}
				if($roleNumber==10){
					echo "禁言长老";
				} ?>
			<td><?php echo $info['GameInfo']['bet'] ?>
		</tr>
	<?php endforeach; ?>
</table>
<?php 
echo $this->Form->create(null,['url'=>['controller'=>'GameInfos','action'=>'win','game_id'=>$gameId]]);
echo $this->Form->end(__('狼人胜利'));
?>
<?php 
echo $this->Form->create(null,['url'=>['controller'=>'GameInfos','action'=>'lose','game_id'=>$gameId]]);
echo $this->Form->end(__('神民胜利'));
?>
<?php } else{ ?>
<table>
	<tr>
		<th>user id</th>
		<th>bet </th>
	</tr>
	<?php foreach ($allInfos as $info): ?>
		<tr>
			<td><?php echo $info['GameInfo']['id'] ?>
			<td><?php echo $info['GameInfo']['bet'] ?>
		</tr>
	<?php endforeach; ?>
</table>
<?php 
echo $this->Form->create(null,['url'=>['controller'=>'Game','action'=>'index']]);
echo $this->Form->end(__('退出游戏'));
?>
<?php } ?>