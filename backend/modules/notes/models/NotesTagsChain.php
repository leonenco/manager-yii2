<?php
namespace backend\modules\notes\models;

use yii\db\ActiveRecord;


/*
 * @property integer $id
 * @property string $title
 * @property integer $frequency
 */
class NotesTagsChain extends ActiveRecord
{


	public function rules(){
		return [				
				[['note_id', 'tag_id'], 'required'],
		];
	}
	public static function tableName(){
		return 'notes_tags_chain';
	}
	
	public function getTag(){
		return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
	}
	/*
	 * 
	 */
	public function getNote(){
		return $this->hasOne(Notes::className(), ['id' => 'note_id']);
	}
}

?>