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
class BonusLimits extends ActiveRecord implements BonusLimitsInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%bonus_limits}}';
    }

    public function decrementAvailable(): self
    {
        if (null === $this->available) {
            return $this;
        }

        if (0 === $this->available) {
            throw new \InvalidArgumentException('Bad bonus');
        }

        $this->available = $this->available - 1;
        $this->save();

        return $this;
    }

}
