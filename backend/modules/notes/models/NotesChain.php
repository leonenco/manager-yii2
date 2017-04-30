<?php
namespace backend\models;

use yii\db\ActiveRecord;


/*
 * @property integer $id
 * @property integer $parent_id
 * @property integer $child_id
 */
class NotesTagChain extends ActiveRecord
{

	public static function tableName(){
		return 'notes_chain';
	}
	public function getNote(){
		return $this->hasOne(Notes::className(), ['id' => 'note_id']);
	}
	public function getChild(){
		return $this->hasOne(Notes::className(), ['id' => 'child_id']);
	}
}
?>