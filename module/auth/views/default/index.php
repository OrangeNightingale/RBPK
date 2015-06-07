<?php 
    namespace app\module\auth;
    $model = new GooglePlus($controllerNamespace ='app\module\auth\controllers', $user_ID, $params);
    $model->googleAuth();
session_start();
?>
<div class="site-index">
    <h1>Google Plus</h1>
        <?php 
        if(empty($_SESSION['user'])):
            echo $model->authURL();
        else:
        ?>
        <div>
            <img src='<?php echo $_SESSION['user']['picture'];?>'></img>
            <h3><?php echo $_SESSION['user']['name'];?></h3>
            <h3><?php echo $_SESSION['user']['email'];?></h3>
            <h3><?php if($_SESSION['user']['gender']=='male'):echo 'Мужской'; else: echo "Женский"; endif;?></h3>
        </div>
    <?php endif;?>
    
        <?php $model->googleAuth();?>
    
</div>
