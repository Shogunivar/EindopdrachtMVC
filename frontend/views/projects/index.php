<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel, 'categories' => $categories]); ?>
   
    <p>
        <?php
            if(Yii::$app->user->can('createProject')) {
                echo Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']);
            }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'Project Owner',
                'filter' => true,
                'value' => function($data){
                    if($data->hideName == 0) {
                        return $data->user->username;
                    } else {
                        return "Hidden owner";
                    }
                }
            ],
            [   
                'header'=> 'Project name',
                'value'=> 'name',
            ],
            [
                'header' => 'Short Description',
                'value' =>'small_description',
            ],
            [
                'header' => 'Category',
                'value' =>'category',
            ],
            [
                'label' => 'Rating',
                'value' => function($data) {
                    $rating = 0;
                    $amountOfRatings = count($data->ratings);
                    foreach($data->ratings as $r) {
                        $rating += $r->rating;
                    }
                      if($amountOfRatings < 1) {
                        $amountOfRatings = 1;
                    }
                    $rating = $rating / $amountOfRatings;
                    return $rating;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
