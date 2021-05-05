<?php


namespace common\models;


/**
 * Bonus model
 *
 * @property integer $bonus_id
 * @property integer $limit
 * @property integer $available
 */
class BonusLimits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%bonus_limits}}';
    }

    public function decrement(): self
    {
        if (null === $this->available) {
            return $this;
        }

        $this->available = $this->available - 1;
        $this->save();
        return $this;
    }

}
