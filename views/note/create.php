<?php

use yii\helpers\Html;


/* @var $this yii\web\View */


?>
<div class="wrapper2 clearfix">
	<?php 
$this->title = 'Новая заметка'?>
	<div style="width: 26%; float:left;">
		<?=
		    $this->render('../user/menu_left', ['current' => 'notes', 'model' => $lcModel]);
		?>
	</div>
	<div style="position:relative; width: 73%; float:left;">
		<div class="panel panel-default">
		  	<div class="panel-body" style = 'padding-top:10px'>
		    	<?= $this->render('_form', [
		        	'model' => $crModel,
		        	'is_user' => $is_user,
		        
		    	]) ?>
			</div>
		</div>
	</div>
</div>

