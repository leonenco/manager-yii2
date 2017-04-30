<?php

namespace backend\modules\settings\models;

use Yii;
use backend\modules\settings\models\CompanyProfile;
use common\models\Profile;
use backend\modules\settings\models\PlanSubscription;
use backend\modules\notes\models\Notes;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \common\models\User
{
	/*
	 * Relation to profile
	 */	
	public function getProfile(){
		return $this->hasOne(Profile::className(), ['user_id' => 'id']);
	}
	
	/*
	 * Relation to company profile
	 */
	public function getCompanyProfile(){
		return $this->hasOne(CompanyProfile::className(), ['user_id' => 'id']);
	}
	/*
	 * Relation to Plan Subscription
	 */
	public function getPlanSubscription(){
		return $this->hasOne(PlanSubscription::className(), ['user_id' => 'id']);
	}
	/**
	 * Relation to Notes
	 */
	public function getNotes()
	{
		return $this->hasMany(Notes::className(), ['created_by' => 'id']);
	}
	/*
	 * Get profile by id
	 * @params ID integer
	 * return object
	 */
	public function getOneProfile($id){
		return Profile::findOne(['user_id' => $id]);
	}
	
	public function beforeSave($insert){
		(empty($this->role)) ? $this->role = 'user' : $this->role;
		if($insert){
			$this->username = $this->email;
			if(empty($this->password)){
				$this->password_hash = self::generatePassword();
			} else {
				$this->password_hash = self::setPassword($this->password);
			}
			$this->auth_key = self::generateAuthKey();
		} else {
			if(!empty($this->password)){
				$this->password_hash = self::setPassword($this->password);
				$this->auth_key = self::generateAuthKey();
			}			
		}			
		return parent::beforeSave($insert);		
	}
	/*
	 * After user object was saved
	 */
	public function afterSave($insert, $changedAttributes){
		if($insert){
			$profile = new Profile();
			$profile->user_id = $this->id;
			$profile->save(false);
			$company = new CompanyProfile();
			$company->user_id = $this->id;
			$company->save(false);
			$subscription = new PlanSubscription();
			$subscription->user_id = $this->id;
			$subscription->notes = true;
			$subscription->save(false);
		}
		$auth = Yii::$app->authManager;
		if($auth->revokeAll($this->id)){
			$authorRole = $auth->getRole($this->role);
			$auth->assign($authorRole, $this->id);
		} else {
			$authorRole = $auth->getRole($this->role);
			$auth->assign($authorRole, $this->id);
		}
		return parent::afterSave($insert, $changedAttributes);
	}
	/*
	 * Generate password
	 * @length integer
	 * return string
	 */
	
	private function generatePassword($length = 8){
		
		$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
		$numChars = strlen($chars);
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$string .= substr($chars, rand(1, $numChars) - 1, 1);
		}
		
		return $string;
		
	}
	public function setPassword($password)
	{
		return Yii::$app->security->generatePasswordHash($password);
	}
	public function generateAuthKey()
	{
		return Yii::$app->security->generateRandomString();
	}
	public function getId()
	{
		return $this->getPrimaryKey();
	}
}
