<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vuelos */

$this->title = 'Create Vuelos';
$this->params['breadcrumbs'][] = ['label' => 'Vuelos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vuelos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
