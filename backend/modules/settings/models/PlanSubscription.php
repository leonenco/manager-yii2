<?php
namespace backend\modules\settings\models;

use yii\db\ActiveRecord;


/*
 * This is model class for table 'company_profile'
 * @property integer $id
 * @property integer $user_id
 * @property bool $notes
 * @property bool projects
 * @property bool $proposals
 * @property bool reports
 * 
 */

class PlanSubscription extends ActiveRecord{
	
	
	/*
	 * 
	 */
	public static function tableName(){
		return 'plan_subscription';
	}
	
	/*
	 * Relation to User
	 */
	public function getUser(){
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
}