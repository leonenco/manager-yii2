<?php
namespace backend\modules\settings\models;

use yii\db\ActiveRecord;

/*
 * @property integer $id
 * @property integer $company_id
 * @property string $access_token
 * @property string $access_token_secret
 * @property string $consumer_key
 * @property string $consumer_key_secret
 * @property integer $realm_id
 * 
 */
class IntuitCredentials extends ActiveRecord{
	
	
	/*
	 * 
	 * 
	 */
	public static function tableName(){
		return 'intuit_credentials';
	}
	/*
	 * Relation to Company profile
	 */
	public function getCompanyProfile(){
		return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
	}
	
}