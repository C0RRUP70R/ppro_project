<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 20:31
 */

namespace app\models;


use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    public static function tableName()
    {
        return 'emp_role';
    }

    public static function getRole($pk){
        return self::find()->where($pk)->one();
    }

    public static function findByName($name){
        return self::find()->where(['role_name' => $name])->one();
    }

}