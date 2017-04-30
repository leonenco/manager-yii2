<?php

namespace backend\modules\settings\models;

use Yii;

/**
 * This is the model class for table "company_managers".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $fullname
 * @property integer $phone
 * @property string $email
 * @property string $photo
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CompanyProfile $company
 */
class CompanyManagers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_managers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'phone', 'status', 'created_at', 'updated_at'], 'integer'],
            [['fullname', 'email', 'photo'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyProfile::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'fullname' => 'Fullname',
            'phone' => 'Phone',
            'email' => 'Email',
            'photo' => 'Photo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(CompanyProfile::className(), ['id' => 'company_id']);
    }
}
