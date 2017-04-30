<?php 
namespace backend\modules\notes\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use backend\models\Users;


/*
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property boolian $folder
 * @property integer $created_by
 * @property timestamp $created_at
 * @property timestamp $updated_at
 */
class Notes extends ActiveRecord 
{
	public $childs;
	//public $tags;
	protected $_user;
	
	public function behaviors()
	{
		return [
				[
					'class' => TimestampBehavior::className(),
				],
				/* [
					'class' => TimestampBehavior::className(),
					'createdAtAttribute' => 'lastVisit',
					'updatedAtAttribute' => 'lastVisit',
					'value' => function () {
						return date('Y-m-d H:i:s');
					}
				], */
		];
	}
	
	/*
	 * Set user value when call class
	 */
	public function beforeValidate(){
		$this->_user = \Yii::$app->user->id;
		return parent::beforeValidate();
	}
	/*
	 * Rulles
	 * 
	 */
	public function rules(){
		return [
				// title and description are required
				[['title', 'description'], 'required'],
				['folder', 'boolean'],
				//['tags', 'string'],
				
		];
	}
	/*
	 * Table
	 */
	public static function tableName(){
		return 'notes_items';
	}
	/*
	 * Relation to join table
	 */
	public function getUser(){
		return $this->hasOne(Users::className(), ['id' => 'created_by']);
	}
	/*
	 * Relation to join table
	 */
	public function getNotesTagsChain(){
		return $this->hasMany(NotesTagsChain::className(), ['note_id' => 'id']);
	}
	/*
	 * Relation to tags table
	 */
	public function getNotesTags(){
		return $this->hasMany(Tags::className(), ['id' => 'tag_id'])->viaTable('notes_tags_chain', ['note_id' => 'id']);
	}
	/*
	 * Before save
	 */
	public function beforeSave($insert){
		if($insert){
			$this->created_by = $this->_user;
		}
		return parent::beforeSave($insert);
	}
	/*
	 * After save function
	 */
	public function afterSave($insert, $changedAttributes){
		if($insert){
			/* 
			 * Creating tags
			 * 
			 * $this->tags = self::PrepString($this->tags);
			foreach ($this->tags as $tag){
				$new_tag = new Tags();
				$new_tag->title = $tag;
				$new_tag->frequency++;
				$new_tag->save(false);
				$chain = new NotesTagsChain();
				$chain->note_id = $this->id;
				$chain->tag_id = $new_tag->getPrimaryKey();
				$chain->save(false);
			} */
		} else {
			/* 
			 * Updating tags 
			 * 
			 *$this->tags = self::PrepString($this->tags);
			/*Delete all previos tags*/
			/* $check_tags = NotesTagsChain::find()->andWhere(['note_id' => $this->id])->all();
			
			foreach ($check_tags as $key){
				foreach ($this->tags as $tag){					
					if(!$update_tag = Tags::find()->andWhere(['title' => $tag])->one()){
						$new_tag = new Tags();
						$new_tag->title = $tag;
						$new_tag->frequency++;
						$new_tag->save(false);
						$chain = new NotesTagsChain();
						$chain->note_id = $this->id;
						$chain->tag_id = $new_tag->getPrimaryKey();
						$chain->save(false);
					} else {
						$update_tag->frequency++;
						$update_tag->save(false);
					}
				}
			} */
		}
		return parent::afterSave($insert, $changedAttributes);
	}
	
	/*
	 * Prepping string
	 * return array
	 */
	private function PrepString($string){
		$array = explode(',', $string);
		foreach ($array as $k => $v){
			$v = trim($v);
			$array[$k] = ucfirst($v);
		}
		return $array;
	}
}

?>