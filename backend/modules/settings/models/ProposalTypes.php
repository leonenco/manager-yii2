<?php

namespace backend\modules\settings\models;

use Yii;

/**
 * This is the model class for table "proposal_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $desc
 */
class ProposalTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proposal_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'desc' => 'Desc',
        ];
    }
}
