<?php
use yii\helpers\Html;
session_start();

$this->title = 'UserPage';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <img src='<?php echo $_SESSION['user']['picture'];?>'></img>
        <h3><?php echo $_SESSION['user']['name'];?></h3>
        <h3><?php echo $_SESSION['user']['email'];?></h3>
        <h3><?php if( $_SESSION['user']['gender']=='male'):echo 'Мужской'; else: echo "Женский"; endif;?></h3>
        <p><a class="btn btn-lg btn-success btn-big_sized" href="?r=notes">Заметки</a></p>
    </div>

   <!-- <code><?= __FILE__ ?></code>-->
</div>
