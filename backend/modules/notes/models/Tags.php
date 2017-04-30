<?php
namespace backend\modules\notes\models;

use yii\db\ActiveRecord;


/*
 * @property integer $id
 * @property string $title
 * @property integer $frequency
 */
class Tags extends ActiveRecord
{

	/*
	 * 
	 */
	public function rules(){
		return [
				// title and description are required
				[['title'], 'required'],

		];
	}
	/*
	 * 
	 */
	public static function tableName(){
		return 'notes_tags';
	}
	/*
	 * 
	 */
	public function getTagsChain(){
		return $this->hasMany(NotesTagsChain::className(), ['tag_id' => 'id']);
	}
	/*
	 * 
	 */
	public function getNotes(){
		return $this->hasMany(Notes::className(), ['id' => 'note_id'])->viaTable('notes_tags_chain', ['tag_id' => 'id']);
	}
}

?>