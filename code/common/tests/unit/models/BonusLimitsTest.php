<?php


namespace common\tests\unit\models;


use Codeception\Test\Unit;
use common\fixtures\BonusLimitsFixture;
use common\models\BonusLimitsInterface;
use common\models\BonusLimits;
use common\tests\UnitTester;

class BonusLimitsTest extends Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected UnitTester $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'bonus_limits' => [
                'class' => BonusLimitsFixture::class,
                'dataFile' => codecept_data_dir(). 'bonus-limits.php'
            ]
        ];
    }

    public function testInstanceOfBonusLimitsInterface()
    {
        $bonusLimits = new BonusLimits;
        $this->assertInstanceOf(BonusLimitsInterface::class, $bonusLimits);
    }

    public function testDecrementAvailableIfIsAvailable()
    {
        /* @var \common\models\BonusLimitsInterface $bonusLimits */
        $bonusLimits = BonusLimits::findOne(['bonus_id' => 1]);
        $bonusLimits->decrementAvailable();

        $this->assertSame(1, $bonusLimits->available);
    }

    public function testDecrementAvailableIfAvailableIsNull()
    {
        /* @var \common\models\BonusLimitsInterface $bonusLimits */
        $bonusLimits = BonusLimits::findOne(['bonus_id' => 2]);
        $bonusLimits->decrementAvailable();

        $this->assertSame(null, $bonusLimits->available);
    }

    public function testDecrementAvailableIfAvailableZero()
    {
        /* @var \common\models\BonusLimitsInterface $bonusLimits */
        $bonusLimits = BonusLimits::findOne(['bonus_id' => 3]);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Bad bonus');
        $bonusLimits->decrementAvailable();
    }

}
