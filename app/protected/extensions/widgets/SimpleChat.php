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
        ?>
        <div class="chat_wrapper">
            <div id="simple_chat">
                <div class="chat_main">
                    <div class="chat_text" id="chat_text">
                    </div>
                    <div class="chat_bottom">
                        <?php
                            $form = new CForm(array(
                                'model' => new Chat,
                                'elements' => array(
                                    "message" => array(
                                        'type' => 'text',
                                        'visible' => true,
                                        'label' => '',
                                        'class' => 'chat_message',
                                    ),
                                ),
                                'buttons' => array(
                                    'login'=>array(
                                        'type'=>'submit',
                                        'label'=>'Send',
                                        'class'=>'button_send'
                                    ),
                                ),
                            ));
                            echo $form->render();

                        ?>
                    </div>
                </div>
                <div class="chat_left hidden_chat"></div>
            </div>
        </div>

    <?php
        $id="simple_chat";
        $options = CJSON::encode($this->options);
        $js = <<<EOD
            $("#{$id}").chat({$options});
EOD;
        Yii::app()->clientScript->registerScript(__CLASS__ . $id . '#handlers', $js);
    }
}