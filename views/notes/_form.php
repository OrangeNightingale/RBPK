<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
session_start();
/* @var $this yii\web\View */
/* @var $model app\models\Notes */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="/MyPregnancy/web/assets/ca974f3f/jquery.js"></script>
<div class="notes-form">
<?php $val =$_SESSION['user']['id'];?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'google_id')->textInput(['maxlength' => true]); ?>
 
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <script>
            (function ($){
                $('.field-notes-google_id').css('display','none');
                $('#notes-google_id').attr('value','<?php echo $_SESSION['user'][id];?>');
                $('#notes-name').attr('value','<?php echo $_SESSION['user'][name];?>');
            })(jQuery);
        </script>
    </div>

    <?php ActiveForm::end(); ?>

</div>
