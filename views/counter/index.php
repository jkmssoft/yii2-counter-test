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
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel jkmssoft\counter\models\CounterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('counter', 'Counters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //$this->render('_search', ['model' => $searchModel]); ?>

    <?= sprintf(
        Yii::t('counter', 'Counter Page Visits: %d'),
        Yii::$app->counter->increase('counter_page_visits')
    ) ?>

    <p>
        <?= Html::a(Yii::t('counter', 'Create Counter'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?php
        if (isset(Yii::$app->request->queryParams['CounterSearch']['visible'])
            && Yii::$app->request->queryParams['CounterSearch']['visible'] == 0) {
            echo Html::a(Yii::t('counter', 'Show All'), ['index'], ['class' => 'btn btn-success']);
        } else {
            echo Html::a(
                Yii::t('counter', 'Show only invisible'),
                ['index', 'CounterSearch[visible]' => '0'],
                ['class' => 'btn btn-success']
            );
        }
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'counter',
            'visible:boolean',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
