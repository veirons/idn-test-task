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
        $limit = $_GET['count'];
        $db = Yii::app()->db;
        $chat_table = Chat::tableName();
        $user_table = User::tableName();
        $where = $_GET['last_id'] ? ' WHERE c.id > ' . $_GET['last_id'] : '';
        $sql = "SELECT c.id, c.datetime, c.message, u.username
                FROM {$chat_table} c
                LEFT JOIN {$user_table} u ON c.user_id = u.id
                {$where}
                order by c.id desc
                LIMIT {$limit}";
        $command=$db->createCommand($sql);
        $rows = $command->queryAll();
        $arr = array();
        $count = count($rows);
        for ($i = $count-1; $i >= 0; $i--){
            $arr[] = array(
                'id' => $rows[$i]['id'],
                'message'=>$rows[$i]['message'],
                'time' => $rows[$i]['datetime'] ? $rows[$i]['datetime'] : '',
                'username' => $rows[$i]['username'] ? $rows[$i]['username'] : 'Guest',
            );
        }
        echo json_encode($arr);
    }

}