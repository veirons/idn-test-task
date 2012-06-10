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
        $db = Yii::app()->db;
        $chat_table = Chat::tableName();
        $user_table = User::tableName();
        $sql = "SELECT * FROM {$chat_table} c LEFT JOIN {$user_table} u ON c.user_id = u.id ";
        $command=$db->createCommand($sql);
        //$command->bindParam(":ID", $id);
        $rows = $command->queryAll();
        $arr = array();

        foreach ($rows as $row) {
            $arr[] = array(
                'id' => $row['id'],
                'message'=>$row['message'],
                'time' => $row['datetime'] ? $row['datetime'] : '',
                'username' => $row['username'] ? $row['username'] : 'Guest',
            );
        }
         echo json_encode($arr);
    }

}