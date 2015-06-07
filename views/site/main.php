
<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<div class="site-index paddings">
<center>
<div style="text-align: center;  font-weight: bold; font-size: 14px; color:#f0f0f0;"><div style="font-size:24px">Добро пожаловать на веб-портал MyPregnancy!</div> <br />
Теперь следить за своей беременностью стало ещё проще!</div>
<br><?php echo Html::a("Войти", Yii::$app->request->BaseUrl."/site/login",
['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom: 5px; width: 400px;']);?>
<?php echo Html::a("Зарегистрироваться", Yii::$app->request->BaseUrl.'/site/registration',
['class'=> 'btn btn-x btn-default', 'style' => 'width: 400px;']); ?>
  <div class="jumbotron">
        <p class='no-padding'><a class="btn btn-lg btn-danger btn-big_sized" href="?r=GooglePlus">Google+</a></p>
    </div>
</div>
</center>
