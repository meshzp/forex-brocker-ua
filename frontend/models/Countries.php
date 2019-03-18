<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "countries".
 *
 * @property string $alpha2_code
 * @property string $alpha3_code
 * @property integer $numeric_code
 * @property string $short_name
 * @property integer $enabled
 * @property string $comment
 */
class Countries extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alpha2_code', 'alpha3_code', 'numeric_code', 'short_name', 'enabled', 'comment'], 'required'],
            [['numeric_code', 'enabled'], 'integer'],
            [['alpha2_code'], 'string', 'max' => 2],
            [['alpha3_code'], 'string', 'max' => 3],
            [['short_name', 'comment'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alpha2_code' => 'Alpha-2 Code',
            'alpha3_code' => 'Alpha-3 Code',
            'numeric_code' => 'Numeric Code',
            'short_name' => 'Short Name',
            'enabled' => 'Enabled',
            'comment' => 'Comment',
        ];
    }
}
