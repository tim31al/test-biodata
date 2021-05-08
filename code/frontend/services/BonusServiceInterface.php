<?php

namespace frontend\services;


use common\models\Bonus;

interface BonusServiceInterface
{
    public function getRandomBonus(): Bonus;
}
