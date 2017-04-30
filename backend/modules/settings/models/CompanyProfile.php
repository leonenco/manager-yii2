<?php
namespace backend\modules\settings\models;

use yii\db\ActiveRecord;
use backend\models\Users;
use backend\modules\settings\models\IntuitCredentials;


/*
 * This is model class for table 'company_profile'
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $city
 * @property string $state
 * @property string	$zip
 * @property string $country
 * @property string $main_address
 * @property string $second_address
 * @property integer $company_type_id
 * @property string $company_categories
 * @property integer $company_status_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property string $relations
 * @property string $extended
 * @property string $logo
 * @property string $lic_number
 * @property integer $insurances_id
 * @property integer $certificates_id
 * @property integer $intuit_profile_id
 */

class CompanyProfile extends ActiveRecord{
	
	/**
	 * Table
	 * @return string
	 */
	public static function tableName(){
		return 'company_profile';
	}
	/*
	 * Rulles
	 */
	public function rules()
	{
		return [
				[['title'], 'string', 'max' => 55],
				[['description','country', 'state', 'city', 'main_address', 'second_address'], 'string'],
				[['phone'], 'string', 'max' => 11],
				[['zip'], 'string', 'max' => 5],
		];
	}
	/*
	 * Relation to Users
	 */
	public function getUser(){
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
	/*
	 * Relation to Comapny type
	 */
	public function getCompanyType(){
		return $this->hasOne(CompanyType::className(), ['id' => 'company_type_id']);
	}
	/*
	 * Relation to Insurances
	 */
	public function getCompanyInsurances(){
		return $this->hasMany(CompanyInsurances::className(), ['company_id' => 'id']);
	}
	
	/*
	 * Relation to Intuit credentials table
	 */
	public function getIntuitCredentials(){
		return $this->hasOne(IntuitCredentials::className(), ['company_id' => 'id']);
	}
	
	public function afterSave($insert, $changedAttributes){
		if($insert){
			$intuit_cred = new IntuitCredentials();
			$intuit_cred->company_id = $this->id;
			$intuit_cred->save(false);
		}
		return parent::afterSave($insert, $changedAttributes);
	}
	
}