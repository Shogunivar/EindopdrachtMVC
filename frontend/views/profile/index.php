<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>
<h1><?= $user->username; ?></h1>

<h2>Projects</h2>
<?php
	if(count($projects) > 0) {
		foreach($projects as $prj) {
			?>
			<form action="hidename" method="post" >
				<strong><?= $prj->name?> </strong>
				<div>
					<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
					<input type="hidden" name="project_id" value="<?= $prj->id ?>">
					<p>show owner name on project: <?= ($prj->hideName == 0) ? 'Yes <button type="submit" id="submit" class="btn btn-succes">hide</button>' : 'No <button type="submit" id="submit" class="btn btn-danger">Show</button>' ?> 
						
					</p>
				</div>
			</form>
			<?php
		}
	} else {
		echo 'You don\'t have any projects yet';
	}
?>

