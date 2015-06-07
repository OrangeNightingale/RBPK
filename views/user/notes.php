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
    $this->title = "Мои заметки"?>
    <div style="width: 26%; float:left;">
        <?=
            $this->render('menu_left', ['current' => 'notes', 'model' => $model]);
        ?>
    </div>
    <div style="position:relative; width: 73%; float:left;">
        <?php
            $notes = $model->getNotes()->orderBy('note_id')->all();
            for($i = 0; $i < $model->getNotes()->count(); $i++)
            {
                echo Html::beginTag('div', ['class' => 'panel panel-default']);
                echo Html::tag('div', Html::tag('span', $notes[$i]->note_text));
                    
                   echo Html::button('Удалить', ['class' => 'btn btn-default pull-right', 'onClick' => 'deleteNote()', 'style' => 'margin-right:10px;']);
                    //['class' => 'panel-heading clearfix']));
                echo Html::beginTag('div', ['class' => 'panel-body']);
               // $image = 'https://api.fnkr.net/testimg/75x75/cccccc/FFF/?text=No+image';
                if ($notes[$i]->foto!="")
                    $image = Yii::$app->request->BaseUrl.'/'.$notes[$i]->foto;
                echo Html::img($image, ['style'=>'width: 75px; height: 75px; float:left; margin-right: 10px;']);
                
                echo Html::endTag('div');
                echo Html::endTag('div');
            }
 echo Html::a("<span class = 'glyphicon glyphicon-plus'></span> Добавить заметку", '../note/create',
                ['class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px; width:160px; float: right;']);
        
           ?>
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
	</div>
