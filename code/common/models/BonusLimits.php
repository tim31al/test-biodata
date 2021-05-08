<?php


namespace common\models;


use yii\db\ActiveRecord;

/**
 * Bonus model
 *
 * @property integer $bonus_id
 * @property integer $limit
 * @property integer $available
 */
class BonusLimits extends ActiveRecord implements BonusLimitInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%bonus_limits}}';
    }

    public function decrementLimit(): self
    {
        if (null === $this->available) {
            return $this;
        }

        $this->available = $this->available - 1;
        $this->save();

        return $this;
    }

}
