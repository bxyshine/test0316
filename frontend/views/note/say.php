<?php
use yii\helpers\Html;
/*use frontend\assets\AppAsset;
AppAsset::register($this);*/

?>
<?=Html::jsFile('@web/public/js/jquery-3.1.1.min.js')?>
<!-- <script src="./assets/js/jquery-3.1.1.min.js"></script> -->
<center>	
<table border="1">
<tr>
	<th>用户名</th>
	<th>密码</th>
	<th>状态</th>
	<th>操作</th>
</tr>
<?php foreach ($arr as $key => $v) { ?>
	<tr>
		<td><?= Html::encode($v['username'])?></td>
		<td><?= Html::encode($v['pwd'])?></td>
		<td><?= Html::encode($v['status'])?></td>
		<td>
			<a href="?r=note/del&id=<?=$v['id'];?>">删除</a>
			<a href="?r=note/update&id=<?=$v['id'];?>">更新</a>
			<a href="?r=note/add">增加</a>
		</td>
	</tr>
<?php }?>
	
</table>
</center>
<script>
	$(function(){
		$.ajax({
			url:'?r=note/ajax',
			type:'get',
			dataType:'json',
			success:function(msg){
				alert(msg);
			}
		})
	})
</script>