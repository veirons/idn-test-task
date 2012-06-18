<?php

 /**
 * Get message is the action class
 * for chat widget, allow to get count last message
 *
 * @author   Valeriy Zhurba <valeriy@5-soft.com>
 * @license  http://display/license proprietary
 * @link     http://rezervator/display/PhpDoc
 */


class GetMessage extends CAction
{
    public function run() {
        $criteria = new CDbCriteria();
        $criteria->with = 'user';
        $criteria->order = 't.id DESC';
        $criteria->limit = (int)($_GET['count']);
        $criteria->condition = 't.id > :last_id';
        $criteria->params = array(':last_id' => (int)($_GET['last_id']));
        $messages = Chat::model()->findAll($criteria);
        $arr = array();
        $count = count($messages);
        for ($i = $count-1; $i >= 0; $i--){
            $arr[] = array(
                'id' => $messages[$i]['id'],
                'message'=>$messages[$i]['message'],
                'time' => $messages[$i]['datetime'] ? $messages[$i]['datetime'] : '',
                'username' => $messages[$i]->user['username'] ? $messages[$i]->user['username'] : 'Guest',
            );
        }
        echo json_encode($arr);
    }

}