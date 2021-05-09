<?php


namespace frontend\tests\unit\models;


use Codeception\Test\Unit;
use common\fixtures\BonusFixture;
use common\fixtures\BonusLimitsFixture;
use common\models\Bonus;
use common\models\BonusInterface;
use frontend\services\BonusService;
use frontend\services\BonusServiceInterface;
use frontend\tests\UnitTester;


class BonusServiceTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected UnitTester $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'bonus' => [
                'class' => BonusFixture::class,
                'dataFile' => codecept_data_dir() . 'bonus.php'
            ],
            'bonus_limits' => [
                'class' => BonusLimitsFixture::class,
                'dataFile' => codecept_data_dir(). 'bonus-limits.php'
            ]
        ];
    }

    public function testInstanceOfBonusServiceInterface()
    {
        $mockBonus = $this->createMock(BonusInterface::class);

        $bonusService = new BonusService($mockBonus);
        $this->assertInstanceOf(BonusServiceInterface::class, $bonusService);
    }

//    public function testGetRandomBonus()
//    {
//        $mockBonus = $this->createMock(BonusInterface::class);
//        $mockBonus
//            ->method('findAvailable')
//            ->willReturn([]);
//
//        $bonusService = new BonusService($mockBonus);
//        $randomBonus = $bonusService->getRandomBonus();
//
//        $this->assertInstanceOf(BonusInterface::class, $randomBonus);
//    }

//    public function testGetRandomBonusException()
//    {
//        $bonus = $this->createMock(Bonus::class);
//        $bonus
//            ->method('findAvailable')
//            ->willReturn([]);
//
//        $bonusService = new BonusService($bonus);
//
//        $randomBonus = $bonusService->getRandomBonus();
//        $this->assertNull($randomBonus);
//    }

}
