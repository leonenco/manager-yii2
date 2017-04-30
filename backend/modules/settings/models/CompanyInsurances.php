<?php
namespace backend\modules\settings\models;

use yii\db\ActiveRecord;


/*
 * @property integer $id
 * @property integer $company_id
 * @property string $title
 * @property string $link
 */
class CompanyInsurances extends ActiveRecord{
	
	
	
	public static function tableName(){
		return 'company_insurances';
	}
	
	/*
	 * Relation to Company profile
	 */
	public function getCompanyProfile(){
		return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
	}
}