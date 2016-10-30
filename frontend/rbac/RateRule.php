<?php
namespace frontend\rbac;

use yii\rbac\Rule;
use app\models\ratings;


class RateRule extends Rule
{
    public $name = 'canRate';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if(count($params['user']->projects) > 0) {
            $rating = Ratings::findOne(['user_id' => $user, 'project_id' => $params['project']->id]);
            if(!is_object($rating)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}