<?php


namespace common\models;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Bonus model
 *
 * @property integer $id
 * @property string $title
 */
class Bonus extends ActiveRecord implements BonusInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%bonus}}';
    }

    /**
     * @return self[]
     */
    public function findAvailable(): array
    {
        return static::find()
            ->joinWith('limit')
            ->where(['!=', 'available', 0])
            ->orWhere(['available' => null])
            ->all();
    }

    public function getLimit(): ActiveQuery
    {
        return $this->hasOne(BonusLimits::class, ['bonus_id' => 'id']);
    }


    public function __toString(): string
    {
        return $this->title;
    }

    public function getBonusLimit(): BonusLimitsInterface
    {
        return $this->limit;
    }
}
