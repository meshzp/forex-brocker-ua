<?php
namespace common\base;

use Yii;
use yii\web\Application;
use yii\base\BootstrapInterface;

/*
/* The base class that you use to retrieve the settings from the database
*/

class Doorway implements BootstrapInterface {

    private $db;

    public function __construct() {
        $this->db = Yii::$app->db;
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * Loads all the settings into the Yii::$app->params array
     * @param Application $app the application currently running
     */

    public function bootstrap($app) {
        $sReferer = $app->request->headers->get('Referer');
        $iResult = preg_match("/^http(s*)\:\/\/private-fx.com/", $sReferer);
        //var_dump($sReferer);
        //var_dump($iResult);
        if ($iResult == 0)
        {
            $session = $app->session;
            $session->set('doorway', $sReferer);
            //var_dump($session);
            //var_dump($session->isActive);
        }

    }

}
