<?php 
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>
<div class="wrapper2 clearfix">
	<?php echo Html::tag('div','Профиль', ['id'=>'page_name']);
	$this->title = "Профиль"?>
	<div style="width: 26%; float:left;">
		<?=
		    $this->render('menu_left', ['current' => 'profile-update', 'model' => $model]);
		?>
	</div>
	<div style="position:relative; width: 73%; float:left;">
		<div class="panel panel-default">
		  	<div class="panel-body">
				<?= $this->render('lc_update_form', [
				        'model' => $model,
				    ]) ?>
		    </div>
		</div>
	</div>
</div>
