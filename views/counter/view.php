<?php

/*
 * This file is part of the yii2-counter project.
 *
 * (c) jkmssoft <http://github.com/jkmssoft/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model jkmssoft\counter\models\Counter */

$this->title = Yii::t('counter', 'View {modelClass}: ', [
    'modelClass' => Yii::t('counter', 'Counter'),
]).$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('counter', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('counter', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('counter', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'counter',
            'visible:boolean',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
