<?php


namespace common\models;


interface BonusLimitsInterface
{
    public function decrementAvailable(): BonusLimits;
}
