<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createProject" permission
        $createProject = $auth->createPermission('createProject');
        $createProject->description = 'Create a project';
        $auth->add($createProject);

        // add "updateProject" permission
        $updateProject = $auth->createPermission('updateProject');
        $updateProject->description = 'Update project';
        $auth->add($updateProject);

        // add "user" role and give this role the "createProject" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createProject);

        // add "admin" role and give this role the "updateProject" permission
        // as well as the permissions of the "user" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateProject);
        $auth->addChild($admin, $user);

        // Assigns role to the admin which has user id 1
        $auth->assign($admin, 1);

        // add the rule
        $rule = new \frontend\rbac\AuthorRule;
        $auth->add($rule);

        // add the "updateOwnProject" permission and associate the rule with it.
        $updateOwnProject = $auth->createPermission('updateOwnProject');
        $updateOwnProject->description = 'Update own project';
        $updateOwnProject->ruleName = $rule->name;
        $auth->add($updateOwnProject);

        // "updateOwnProject" will be used from "updatePost"
        $auth->addChild($updateOwnProject, $updateProject);

        // allow "author" to update their own posts
        $auth->addChild($user, $updateOwnProject);

        $giveRating = $auth->createPermission('giveRating');
        $giveRating->description = 'Give a rating to a project';
        $auth->add($giveRating);

        // add the rule
        $rateRule = new \frontend\rbac\RateRule;
        $auth->add($rateRule);

        // add the "updateOwnProject" permission and associate the rule with it.
        $rateProject = $auth->createPermission('RateProject');
        $rateProject->description = 'Rate a project';
        $rateProject->ruleName = $rateRule->name;
        $auth->add($rateProject);

         // "updateOwnProject" will be used from "updatePost"
        $auth->addChild($rateProject, $giveRating);

        // allow "author" to update their own posts
        $auth->addChild($user, $rateProject);
        $auth->addChild($user, $giveRating);
    }
}