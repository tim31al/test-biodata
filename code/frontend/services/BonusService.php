<?php

namespace frontend\services;

use common\models\Bonus;
use common\models\BonusInterface;
use yii\base\InvalidArgumentException;

class BonusService implements BonusServiceInterface
{
    private BonusInterface $bonus;

    /**
     * BonusService constructor.
     * @param \common\models\BonusInterface $bonus
     */
    public function __construct(BonusInterface $bonus)
    {
        $this->bonus = $bonus;
    }


    public function getRandomBonus(): ?Bonus
    {
        $bonuses = $this->bonus->findAvailable();

        if (!count($bonuses)) {
            return null;
        }

        $maxIndex = count($bonuses) - 1;
        $index = rand(0, $maxIndex);

        /* @var BonusInterface $bonus */
        $bonus = $bonuses[$index];
        $bonus->getBonusLimit()->decrementAvailable();

        return $bonus;
    }
}
