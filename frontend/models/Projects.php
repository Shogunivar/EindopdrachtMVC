<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $small_description
 * @property string $description
 * @property string $image
 * @property string $category
 * @property integer $hideName
 *
 * @property User $user
 * @property Ratings[] $ratings
 * @property User[] $users
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'small_description', 'description', 'category'], 'required'],
            [['user_id', 'hideName'], 'integer'],
            [['description'], 'string'],
            [['name', 'image', 'category'], 'string', 'max' => 255],
            [['small_description'], 'string', 'max' => 140],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'small_description' => 'Small Description',
            'description' => 'Description',
            'image' => 'Image',
            'category' => 'Category',
            'hideName' => 'Hide Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('ratings', ['project_id' => 'id']);
    }
}
