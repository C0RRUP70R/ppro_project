<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 20:38
 */

namespace app\models;


use yii\db\ActiveRecord;

class HolidayRequest extends ActiveRecord
{
    public static function tableName()
    {
        return 'holiday_request';
    }

    public function getEmployee(){
        return $this->hasOne(Employee::className(), ['employee_pk' => 'employee_pk']);
    }

    public function getApprover(){
        return $this->hasOne(Employee::className(), ['employee_pk' => 'approved_by']);
    }

}