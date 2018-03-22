<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reservas */

$this->title = 'Create Reservas';
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
