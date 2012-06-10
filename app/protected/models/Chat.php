<?php

class Chat extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_chat':
	 * @var integer $id
	 * @var datetime $datetime
	 * @var string $message
	 * @var int $user_id
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{chat}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('message', 'length', 'max'=>100),
			array('profile', 'safe'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'datetime' => 'Datetime',
			'message' => 'Message',
		);
	}
}