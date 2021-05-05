<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fb-user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'created_at',
                'label'=>'Created',
                'format'=>'datetime',
            ],
            [
                'attribute'=>'bonus_id',
                'label'=>'Bonus',
                'format'=>'text',
                'content'=>function($data){
                    return $data->bonus;
                },
            ],
        ],
    ]); ?>


</div>
