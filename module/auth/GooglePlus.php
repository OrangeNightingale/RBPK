<?php

namespace app\module\auth;
use  yii\web\Session;
session_start();
class GooglePlus extends \yii\base\Module
{
    public $controllerNamespace;
    public $client_id;
    public $client_secret;
    public $redirect_link = 'http://localhost/MyPregnancy';
    public $url = 'https://accounts.google.com/o/oauth2/auth';
    public $params;
    public function __construct($controllerNamespace, $client_id, $params = array())
    {
        parent::__construct($controllerNamespace ='app\module\auth\controllers' , $client_id, $params);
        $this->controllerNamespace = 'app\module\auth\controllers';
        $this->client_id = '808698831575-vltriqgk1vqkec6b46al7u67f4f54r0r.apps.googleusercontent.com';
        $this->client_secret = 'fIKN16gPbUJESOsyPO_NCVLx';
        $this->redirect_link = 'http://localhost/MyPregnancy/web/index.php/?r=GooglePlus';
        $this->url ='https://accounts.google.com/o/oauth2/auth';
        $this->params = array(
                                'redirect_uri' => $this->redirect_link,
                                'response_type' => 'code',
                                'client_id'      => $this->client_id,
                                'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
                            );
    }

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    public function authURL()
    {
        parent::__construct($controllerNamespace ='app\module\auth\controllers' , $client_id, $params);
        $url = 'https://accounts.google.com/o/oauth2/auth';
        
        return $link = '<p><a class="btn btn-lg btn-success btn-big_sized" href="' . $url . '?' .urldecode(http_build_query($this->params)) .'">Аутентификация через Google</a></p>';
    }

   public function googleAuth()
   {
   parent::__construct($controllerNamespace ='app\module\auth\controllers' , $client_id, $params);
       
       if (isset($_GET['code'])) 
        {   
            $result = false;

            $params = array(
                'client_id'     =>$this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri'  => $this->redirect_link,
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);
            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) 
            {
                $params['access_token'] = $tokenInfo['access_token'];

                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
                $_SESSION['user'] = $userInfo;
                $_POST['userInfo'] = $_SESSION['user'];
                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
            }

        }
        return $_SESSION['user'];
   }
}
