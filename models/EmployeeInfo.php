<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 20:36
 */

namespace app\models;


use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class EmployeeInfo extends ActiveRecord
{
    public static function tableName()
    {
        return 'employee_info';
    }

    public function getDataProvider($id = null)
    {
        if ($id) {
            $query = $this->find()->where(['employee_info_pk' => $id]);
        } else {
            $query = $this->find();
        }

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }
}