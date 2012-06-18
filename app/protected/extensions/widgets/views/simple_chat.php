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