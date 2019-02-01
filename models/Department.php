<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 20:23
 */

namespace app\models;


use yii\db\ActiveRecord;

class Department extends ActiveRecord
{
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['department_pk' => 'department_pk']);
    }

    public function getApprovedRequests()
    {
        return $this->hasMany(HolidayRequest::className(), ['employee_pk' => 'employee_pk'])
            ->via('employees')
            ->where('approved = :approved', ['approved' => true])
            ->orderBy('holiday_request_pk');
    }

    public function getUnapprovedRequests()
    {
        return $this->hasMany(HolidayRequest::className(), ['employee_pk' => 'employee_pk'])
            ->via('employees')
            ->where('approved = :approved', ['approved' => false])
            ->orderBy('holiday_request_pk');
    }
}