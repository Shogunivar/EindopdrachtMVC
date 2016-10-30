<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\projects;

class ProfileController extends \yii\web\Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                 [
                    'allow' => true,
                    'verbs' => ['POST']
                ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'hidename' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex($id)
    {
    	$projects = new projects;
    	$projects = $projects->find()->where(['user_id' => $id])->all();

    	if(Yii::$app->user->identity->id == $id)
    	{
	        return $this->render('index', [
	            'user' => Yii::$app->user->identity,
	            'projects' => $projects,
	        ]);
	    }	
	    else {
	    	return $this->render('error');
	    }
    }

    public function actionHidename() {
    	$project = new projects;
    	$project_id = Yii::$app->request->post('project_id');
    	$project = $project->find()->where(['id' => $project_id])->one();

    	if($project->hideName == 0) {
    		$project->hideName = 1;
    	} else {
    		$project->hideName = 0;
    	}
    	$project->save();
    	return $this->redirect(Yii::$app->request->referrer);
    }

}
