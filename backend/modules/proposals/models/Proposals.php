<?php

namespace backend\modules\proposals\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "proposals".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $address
 * @property integer $proposal_type_id
 * @property integer $status_id
 * @property integer $customer_id
 * @property integer $manager_id
 * @property double $est_price
 * @property integer $edited_by *
 * @property User $createdBy
 */
class Proposals extends \yii\db\ActiveRecord
{
    const STATUS_DONE = 10;
    const STATUS_SCHEDULED = 9;
    const STATUS_APROVED = 8;
    const STATUS_AWAITING_APROVAL = 7;
    const STATUS_ACTIVE = 6;
    const STATUS_NOT_APROVED = 3;
    const STATUS_CLOSED = 1;
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposals';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['created_by', 'proposal_type_id', 'status_id', 'customer_id', 'manager_id', 'edited_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['est_price'], 'double'],
            [['title'], 'string', 'max' => 55],
            [['address'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            ['status_id', 'in', 'range' => [
                self::STATUS_DONE,
                self::STATUS_SCHEDULED,
                self::STATUS_APROVED,
                self::STATUS_AWAITING_APROVAL,
                self::STATUS_ACTIVE,
                self::STATUS_NOT_APROVED,
                self::STATUS_CLOSED,
            ]],
            ['status_id', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'address' => 'Address',
            'proposal_type_id' => 'Proposal Type ID',
            'status_id' => 'Status ID',
            'customer_id' => 'Customer ID',
            'manager_id' => 'Manager ID',
            'est_price' => 'Est Price',
            'edited_by' => 'Edited By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
