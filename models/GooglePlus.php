<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * GooglePlus is the model behind the login form.
 */
class GooglePlus extends \yii\base\Object
{
   public $client_id = '381455114633-pboats9spphbmfkqomp7psnrc0e7bvt2.apps.googleusercontent.com'; 
   public $client_secret = 'mFeL2GglfhQfXVmqRN6e36iv';
   public $redirect_uri = 'http://localhost/MyPregnancy';
   public $url = 'https://accounts.google.com/o/oauth2/auth';
   public $params = array(
    'redirect_uri'  => GooglePlus::redirect_uri,
    'response_type' => 'code',
    'client_id'     => GooglePlus::client_id,
    'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
    );
   
   public function googleAuth()
   {
       $link = '<p><a href="' . GooglePlus::url . '?' .urldecode(http_build_query(GooglePlus::params)) .'">Аутентификация через Google</a></p>';
       if (isset($_GET['code'])) 
        {   
            $result = false;

            $params = array(
                'client_id'     => GooglePlus::client_id,
                'client_secret' => GooglePlus::client_secret,
                'redirect_uri'  => GooglePlus::redirect_uri,
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
                if (isset($userInfo['id'])) {
                    $userInfo = $userInfo;
                    $result = true;
                }
            }

            if ($result) 
            {
                $output = 'Социальный ID пользователя: ' . $userInfo['id'] . '<br />';
                $output +='Социальный ID пользователя: ' . $userInfo['id'] . '<br />';
                $output +='Имя пользователя: ' . $userInfo['name'] . '<br />';
                $output +='Email: ' . $userInfo['email'] . '<br />';
                $output +='Ссылка на профиль пользователя: ' . $userInfo['link'] . '<br />';
                $output +='Пол пользователя: ' . $userInfo['gender'] . '<br />';
                $output +='<img src="' . $userInfo['picture'] . '" /><br />';
            }

        }
        $_SESSION['user'] = $userInfo;
        return $output;
   }
}
