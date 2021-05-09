<?php


namespace common\tests\unit\models;


use Codeception\Test\Unit;
use common\fixtures\BonusFixture;
use common\fixtures\BonusLimitsFixture;
use common\models\Bonus;
use common\models\BonusInterface;
use common\models\BonusLimitsInterface;
use common\tests\UnitTester;

class BonusTest extends Unit
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


    public function testBonusInstanceOfBonusInterface()
    {
        $bonus = new Bonus();
        $this->assertInstanceOf(BonusInterface::class, $bonus);
    }

    public function testFindAvailable()
    {
        $bonus = new Bonus();
        $available = $bonus->findAvailable();

        $this->assertCount(2, $available);
    }

    public function testToString()
    {
        $bonus = Bonus::findOne(['id' => 1]);

        $this->assertStringContainsString('Bonus 1', $bonus);
    }

    public function testGetBonusLimit()
    {
        $bonus = Bonus::findOne(['id' => 1]);
        $this->assertInstanceOf(BonusLimitsInterface::class, $bonus->getBonusLimit());
    }

}
