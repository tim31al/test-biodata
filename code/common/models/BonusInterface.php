<?php


namespace common\models;


interface BonusInterface
{
    /**
     * @return Bonus[]
     */
    public function findAvailable(): array;
    public function getBonusLimit(): BonusLimitsInterface;
}
