<?php
namespace backend\modules\settings\models;

use yii\db\ActiveRecord;

/*
 * @property integer $id
 * @property string $title
 * @property string $description
 */

class CompanyType extends ActiveRecord{
	
	public static function tableName(){
		return 'company_type';
	}
	
	public function rules(){
		return [
                    [['title', 'description'], 'required'],
                    [['title'], 'string', 'max' => 55],
		];
	}
	
	/*
	public function getCompanyProfile(){
		return $this->hasMany(CompanyProfile::className(), ['company_type_id' => 'id']);
	}
	*/
}