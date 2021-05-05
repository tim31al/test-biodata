<?php

/* @var $this yii\web\View */

/* @var \frontend\models\FbUser $user */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

$bonusUrl = Url::to(['site/profile?getBonus=true']);
$email = $user->getEmail();
$bonus = $user->bonus;

?>
<div class="user-profile">
	<h1><?= Html::encode($this->title) ?></h1>

	<div class="row">
		<div class="col-lg-5">
			<h2><?= $user->getName() ?></h2>
            <?php if ($email): ?>
			<p class="mt-4">Email: <?= $user->getEmail() ?></p>
			<?php endif; ?>

            <?php if ($bonus): ?>
			<p class="mt-4">Bonus: <?= $bonus ?></p>
            <?php else: ?>
			<p class="mt-4">
				<a href="<?= $bonusUrl ?>" class="btn btn-success">Получить бонус</a>
			</p>
            <?php endif; ?>

		</div>

		<div class="col-lg-5">
		</div>
	</div>

</div>
