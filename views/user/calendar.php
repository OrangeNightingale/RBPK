<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
Yii::$app->user->returnUrl = Yii::$app->request->getAbsoluteUrl();
?>
<div class="wrapper2 clearfix">
    <?php 
    $this->title = "Календарь"?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('menu_left', ['current' => 'calendar', 'model' => $model]);
        ?>
    </div>
    <div style="position:relative; width: 73%; float:left;">
	<center>
<div style="text-align: center;  font-weight: bold; font-size: 14px; color:#1e2349;">
<div style="font-size:24px">Здесь будет отображаться календарь посещений врача и другие важные события.</div>
	<?php
         echo Html::a("<span class = 'glyphicon glyphicon-plus'></span> Добавить событие", '../note/create',
                ['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px; width:160px; float: right;']);
	?>   
   </div>
</div>
