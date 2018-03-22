<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompaniasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Companias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'denominacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
