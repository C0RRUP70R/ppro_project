<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 18:31
 */

namespace app\models;


use yii\db\ActiveRecord;

class Employee extends ActiveRecord
{
    public static function tableName()
    {
        return 'employee';
    }

    public static function loadToArray($emp){

        if($emp){
            $user = $emp->attributes;
        } else{
            return null;
        }

        $user_arr = [
            'id' => $user['employee_pk'],
            'username' => $user['username'],
            'password' => $user['password'],
            'authKey' => 'key'.$user['password'],
            'accessToken' => 'token'.$user['password'],
            'role' => $user['role_id']
        ];
        return $user_arr;
    }

}