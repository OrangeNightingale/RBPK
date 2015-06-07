<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\models\Group;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\RegistrationForm */

$this->title = 'Регистрация';
?>


<div class="wrapper2" style="overflow:auto;"><div id="page_name">Регистрация</div><center>

     <div class="site-login" style='margin-top:70px '>
     <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal '],
        'fieldConfig' => [
            'template' => "<div class=\"col-lg-12\" ><div style=\" float:left;\">{label}</div>\n</div><div class=\"col-lg-12\">{input}<div style=\" float:left;\">{error}</div></div>"
        ],
    ]); ?>
            <?= $form->field($model, 'name')->textInput()?>
            <?= $form->field($model, 'second_name')->textInput()?>
            <?= $form->field($model, 'email')->textInput()?>
            <?= $form->field($model, 'password')->passwordInput()?>
            <?= $form->field($model, 'confirmation')->passwordInput()?>

          
        

        <br><br>

        <div class="form-group ">
          <div class="col-lg-12">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-block btn-lg ', 'name' => 'Submit']) ?>
          </div>
        </div>
        <?php ActiveForm::end(); ?>
        <br><br>
    </div>
    </center>
</div>
<script>

function show(id, id2)
{
    if (document.getElementById(id).style.display == 'none')
    {
        document.getElementById(id).style.display = 'block';
        document.getElementById(id2).style.display = 'none';
    }
}
</script>