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
    $this->title = "Мои друзья"?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('menu_left', ['current' => 'friends', 'model' => $model]);
        ?>
    </div>
    <div style="position:relative; width: 73%; float:left;">
        <?php
            $user = $model->getFriends()->orderBy('id')->all();
            for($i = 0; $i < $model->getFriends()->count(); $i++)
            {
                echo Html::beginTag('div', ['class' => 'panel panel-default']);
                echo Html::tag('div', Html::tag('span', $user[$i]->name));
                echo Html::beginTag('div', ['class' => 'panel-body']);
               // $image = 'https://api.fnkr.net/testimg/75x75/cccccc/FFF/?text=No+image';
				//if ($weeks[$i]->foto!="")
                   // $image = Yii::$app->request->BaseUrl.'/'.$weeks[$i]->foto;
               // echo Html::img($image, ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px;']);
                
                echo Html::endTag('div');
                echo Html::endTag('div');
            }
echo Html::a("<span class = 'glyphicon glyphicon-plus'></span> Добавить друзей", '',
                ['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px; width:160px; float: right;']);
        
           ?>
    </div>
</div>
