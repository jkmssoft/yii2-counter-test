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

/* @var $this yii\web\View */
/* @var $model jkmssoft\counter\models\Counter */

$this->title = Yii::t('counter', 'Create Counter');
$this->params['breadcrumbs'][] = ['label' => Yii::t('counter', 'Counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
