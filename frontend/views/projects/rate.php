<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\projects */

$this->title = $model->project->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="projects-rate">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rating')->textInput(['type' => 'number']); ?>

    <div class="form-group">
        <?= Html::submitButton('rate') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>