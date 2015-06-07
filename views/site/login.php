<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\BootstrapPluginAsset;

BootstrapPluginAsset::register($this);
$this->title = 'Авторизация';

?>
<div class="wrapper2"><div id="page_name"><?= Html::encode($this->title) ?></div>
    <div class="site-login" style='margin-top:70px'>
          <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                'template' => "<div class=\"col-lg-12\">{input}{error}</div>\n"
            ],
        ]); ?>

       <?= Html::label('Ваш email') ?> <?= $form->field($model, 'email')->textInput(['placeholder'=>'Ваш email'])?>

        <?= Html::label('Ваш пароль') ?> <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Ваш пароль']) ?>

        <div class="form-group">
            <div class="col-lg-12">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block btn-lg', 'name' => 'login-button']) ?>
                <?= Html::label('Забыли пароль?', 0, ['style' => "text-decoration:underline;  color: #003366; cursor: pointer;", 'onclick' =>"openModal()", 'class'=>'reg-message']) ?>
            </div>
        </div>      
     </div>
</div>

<div class="modal fade bs-example-modal-sm" id='myModal' tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                <h4 class="modal-title" id="modalLabel"></h4>
            </div>
            <div class="modal-body">
                <input class="form-control" placeholder='Email' id='email'></input>
            </div>
            <div class="modal-footer">
                <button id='sendResponseButton' type="button" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

function recovery(email)
 {
    alert(email);
     $.ajax({
      type     :'POST',
      cache    : false,
      url  : '../site/recovery',
      data: {'email':email},
      statusCode: {
        500: function(data){alert('Error!\n'+data.responseText);},
        200: function(){$('#'+id).hide('slow');}
      }
    });
 }

function openModal()
{
   $('#modalLabel').text('Запрос на смену пароля');
   $('#email').val('');
   $('#sendResponseButton').click(function()
    {
        var email = $('#email').val();
        recovery(email);
        $('#myModal').modal('hide');
    });

    $('#myModal').modal('show');
 }
</script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '387856838047937',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>