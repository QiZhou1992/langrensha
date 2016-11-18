<div class="users form">
<?php echo $this->Form->create('GameInfo'); ?>
    <fieldset>
        <legend><?php echo __('加入游戏'); ?></legend>
        <?php 
        	echo $this->Form->input('role',array('type'=>'select','label'=>'选择角色','options'=>[1=>'村民', 2=>'狼人', 3=>'白狼王', 4=>'狼美人', 5=>'预言家',6 =>'女巫', 7=>'守卫', 8=>'猎人',9=>'白痴',10=>'禁言长老'],'default'=>1));
        	echo $this->Form->input('number',array('type'=>'select','label'=>'选择号码','options'=>[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20],'default'=>1));
			echo $this->Form->input('bet',array('type'=>'select','label'=>'选择下注','options'=>$Coins,'default'=>0));
    	?>
    </fieldset>
<?php echo $this->Form->end(__('提交')); ?>
</div>