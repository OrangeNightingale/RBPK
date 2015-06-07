<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\bootstrap\BootstrapPluginAsset;

BootstrapPluginAsset::register($this);

echo Nav::widget([
    'items' => [
        "<li class='left-info'><b>".$model->name.'</b><br>'.
        $model->email . '<br>' .
		

        Html::tag("li", "<a href='../user/weeks'><span class = 'glyphicon glyphicon-list'></span> Беременность по неделям</a>",
            ['class' => ($current == 'weeks') ? 'active' : '']),

        Html::tag("li", "<a href='../user/friends'><span class = 'glyphicon glyphicon-stats'></span> Мои друзья</a>",
            ['class' => ($current == 'friends') ? 'active' : '']),

        Html::tag("li", "<a href='../user/notes'><span class = 'glyphicon glyphicon-question-sign'></span> Мои заметки</a>",
            ['class' => ($current == 'notes') ? 'active' : '']),

        Html::tag("li", "<a href='../user/calendar'><span class = 'glyphicon glyphicon-list-alt'></span> Мой календарь</a>", 
            ['class' => ($current == 'calendar') ? 'active' : '']),

        Html::tag("li", "<a href='../user/profile-update'><span class = 'glyphicon glyphicon-pencil'></span> Редактировать профиль</a><hr>",
            ['class' => ($current == 'profile-update') ? 'active' : '']),

        
        Html::tag("li", "<a href='javascript:askLogout();' id='logout_button'><span class = 'glyphicon glyphicon-log-out'></span> Выйти</a>"),

    ],
    'options' => ['class' => 'nav-pills nav-stacked',
    				 'style' => 'margin:0 20px 20px 10px; padding:5px; border-radius: 4px; border:1px solid #DDDDDD; background:#fff'],
]);?>
<a href='<?=Yii::$app->request->BaseUrl."/site/logout";?>' data-method='post' style="visibility:none;height:0px;" id="logout_href"></a>
<div class="modal fade bs-example-modal-sm" id='myModal' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modalLabel"></h4>
            </div>
            <div class="modal-body">
                <textarea rows=5 class="form-control" placeholder='Опишите свой вопрос или проблему' id='problem'></textarea>
            </div>
            <div class="modal-footer">
                <button id='sendMailButton' type="button" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>
</div>

 <script>
 function askLogout()
 {
    if (confirm('Вы уверены, что хотите выйти?'))
        $('#logout_href').click();
 }
 function mailAdmin(problem)
 {
    $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../lecturer/mail-admin',
      data: {'problem':problem},
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);}
      }
    });
 }

 function openModal()
 {
    $('#modalLabel').text('Письмо администратору');
    $('#problem').val('');

    $('#sendMailButton').click(function()
    {
        var problem = $('#problem').val();
        if(! (problem.length == 0))
        {
            mailAdmin(problem);
            $('#myModal').modal('hide');
        }
    });

    $('#myModal').modal('show');
 }
 </script>

