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
class Bonus extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%bonus}}';
    }

    public static function findAvailable(): array
    {
        return static::find()
            ->joinWith('limit')
            ->where(['!=', 'available', 0])
            ->orWhere(['available' => null])
            ->all();
    }

     public static function giveRandomBonus(): self
     {
         $bonuses = self::findAvailable();
         $count = count($bonuses) - 1;
         $index = rand(0, $count);

         $bonus = $bonuses[$index];
         $bonus->limit->decrement();

         return $bonus;
     }

    public function getLimit(): ActiveQuery
    {
        return $this->hasOne(BonusLimits::class, ['bonus_id' => 'id']);
    }


    public function __toString(): string
    {
        return $this->title;
    }

}
