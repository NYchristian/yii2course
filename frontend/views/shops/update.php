<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shops */

$this->title = 'Update Shops: ' . $model->shop_id;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shop_id, 'url' => ['view', 'id' => $model->shop_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shops-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>