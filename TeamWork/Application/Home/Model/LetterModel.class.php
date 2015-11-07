<?php
namespace Home\Model;
use Think\Model\RelationModel;

class LetterModel extends RelationModel
{
    protected $tableName = "letter";

		protected $_link = array(
        'teacher' => array(
            'mapping_type' => self::BELONGS_TO,
            'mapping_name' => 'teacher',
            'foreign_key'  => 'teacher_id'
        ),

    );
}