<?php
/**
 * Created by JetBrains PhpStorm.
 * User: developer
 * Date: 23.03.12
 * Time: 9:11
 * To change this template use File | Settings | File Templates.
 */


class SimpleChat extends CWidget
{
    public $options;

    public static function actions(){
        return array(
           // naming the action and pointing to the location
           // where the external action class is
           'getMessage'=>'ext.widgets.getMessage',
           'addMessage'=>'ext.widgets.addMessage',
        );
    }

    public function init()
    {
        $am = Yii::app()->assetManager;
        $assetPath = $am->publish(dirname(__FILE__) . '/assets');
        $cs = Yii::app()->clientScript;
        $script = YII_DEBUG ? 'simple_chat.js' : 'simple_chat.js';
        $cs->registerScriptFile($assetPath. '/jquery-ui-1.8.21.custom.min.js');
        $cs->registerScriptFile($assetPath . '/' . $script);
        Yii::app()->clientScript->registerCssFile($assetPath . '/css/simple_chat.css');

    }

    public function run() {
        $this->render('simple_chat');
    }
}