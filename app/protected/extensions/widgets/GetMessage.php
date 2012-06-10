<?php
/**
 * Created by JetBrains PhpStorm.
 * User: developer
 * Date: 23.03.12
 * Time: 9:11
 * To change this template use File | Settings | File Templates.
 */


class GetMessage extends CAction
{
    public function run()
	{
       echo 'eee';
    }

    public function getMessages(){
        $messages = Chat::model()->findAll();
        $arr = array();

        foreach ($messages as $message) {
            $arr[] = array(
                'id'=>$message->id,
                'message'=>$message->message,
            );
        }
         echo json_encode($arr);
    }
}