<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>
<div class="wrapper2 clearfix">
    <?php
    $this->title = "Неделя\"" . $model->week_id . "\""?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('../user/menu_left', ['current' => 'weeks', 'model' => $User]);
        ?>
    </div>

    <div style="position:relative; width: 73%; float:left;">

        <div class="panel panel-default">
            <div class="panel-heading"><b>Общая информация</b></div>
            <div class="panel-body">
			<?php
              echo Html::beginTag('div', ['class' => 'panel-body']);
                $image = 'https://api.fnkr.net/testimg/75x75/cccccc/FFF/?text=No+image';
                if ($model->foto!="")
                    $image = Yii::$app->request->BaseUrl.'/'.$model->foto;
                echo Html::img($image, ['style'=>'width: 125px; height: 125px; float:left; margin-right: 10px;']);
                echo Html::tag('div', mb_substr($model->description, 0, 1000).'...');
                echo Html::endTag('div');
				?>
            
            </div>
        </div>

    </div>
</div>