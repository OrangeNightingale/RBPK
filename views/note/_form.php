<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>


    <?= $form->field($model, 'note_text')->textarea(['rows' => 6]) ?>

	<?php if($is_user)
			echo Html::activeHiddenInput($model, 'user_id');
		else
			echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'name'))	
	?>    

    <?= $form->field($model, 'foto')->fileInput(['accept'=>"image/gif, image/jpeg, image/png"]) ?>
    <?php if ($model->foto!="") echo "<img src='".Yii::$app->request->BaseUrl."/{$model->foto}' width='100px' />"?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' pull-right']) ?>
        <?php if($is_user && Yii::$app->controller->action->id != 'create')
                echo Html::button('Удалить', ['class' => 'btn btn-default pull-right', 'onClick' => 'deleteNote()', 'style' => 'margin-right:10px;']); ?>
    </div>

    <script>
    function deleteNote()
    {
        if (confirm("Вы действительно хотите удалить данную заметку?"))
        {   
            $.ajax({
                type     :'POST',
                url  : 'delete?id=' + window.location.search.substring(1).split('=')[1],
                success: function(){window.location = "../user/notes";},
               
            });            
        }
    }
    </script>

    <?php ActiveForm::end(); ?>

</div>
