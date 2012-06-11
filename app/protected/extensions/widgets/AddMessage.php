<?php
/**
 * AddMessage is the action class
 * for chat widget, allow save message to database
 *
 * @author   Valeriy Zhurba <valeriy@5-soft.com>
 * @license  http://display/license proprietary
 * @link     http://rezervator/display/PhpDoc
 */

class AddMessage extends CAction
{
    public function run()
    {
        $chat = new Chat;
        if (isset($_POST['Chat'])) {
            $chat->setAttribute('message', strip_tags($_POST['Chat']['message']));
            $chat->setAttribute('datetime', Yii::app()->dateFormatter->format('yyyy.MM.dd HH:m:s', time()));
            $chat->setAttribute('user_id', Yii::app()->user->id);
            if($chat->save()) echo '1';
        }
    }
}