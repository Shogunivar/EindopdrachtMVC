<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
        if(Yii::$app->user->can('updateProject', ['project' => $model])) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php
            }
            $rating = 0;
            $amountOfRatings = count($model->ratings);
            if($amountOfRatings < 1) {
                $amountOfRatings = 1;
            }
            foreach ($model->ratings as $r) {
                $rating += $r->rating;
            }
            $rating = $rating / $amountOfRatings;
            echo '<strong> Average rating: ' . $rating . '</strong>'; echo (count($model->ratings) > 0) ? ' Rated by ' . $amountOfRatings . ' users': '';
            if(Yii::$app->user->can('giveRating', ['project' => $model, 'user' => $user])) {
        ?>
        <?= Html::a('Rate', ['rate', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            }
        ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'name',
            'small_description',
            'description:ntext',
            'category',
        ],
    ]) ?>

</div>
