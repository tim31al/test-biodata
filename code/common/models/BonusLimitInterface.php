<?php


namespace common\models;


interface BonusLimitInterface
{
    public function decrementLimit(): BonusLimits;
}
