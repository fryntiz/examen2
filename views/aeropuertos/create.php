<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aeropuertos */

$this->title = 'Create Aeropuertos';
$this->params['breadcrumbs'][] = ['label' => 'Aeropuertos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aeropuertos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
