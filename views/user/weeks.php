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
    $this->title = "Беременность по неделям"?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('menu_left', ['current' => 'weeks', 'model' => $model]);
        ?>
    </div>
    <div style="position:relative; width: 73%; float:left;">
        <?php
            $weeks = $model->getWeeks()->orderBy('week_id')->all();
            for($i = 0; $i < $model->getWeeks()->count(); $i++)
            {
                echo Html::beginTag('div', ['class' => 'panel panel-default']);
                echo Html::tag('div', Html::tag('span', $weeks[$i]->week_text .
                    
                    Html::a('Просмотр', '../week/view?id=' . $weeks[$i]->week_id,['class' => 'btn btn-xs btn-primary', 'style' => 'float: right;margin-left: 20px;']),
                    ['class' => 'panel-heading clearfix']));
                echo Html::beginTag('div', ['class' => 'panel-body']);
                $image = 'https://api.fnkr.net/testimg/75x75/cccccc/FFF/?text=No+image';
                if ($weeks[$i]->foto!="")
                    $image = Yii::$app->request->BaseUrl.'/'.$weeks[$i]->foto;
                echo Html::img($image, ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px;']);
                
                echo Html::endTag('div');
                echo Html::endTag('div');
            }

           ?>
    </div>
</div>
