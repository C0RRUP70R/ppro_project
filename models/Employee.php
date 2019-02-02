<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 18:31
 */

namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Employee
 * @package app\models
 *
 * @var $department_pk
 */
class Employee extends ActiveRecord
{
    public static function tableName()
    {
        return 'employee';
    }

    public function getRequests()
    {
        return $this->hasMany(HolidayRequest::className(), ['employee_pk' => 'employee_pk']);
    }

    public function getApprovedRequests()
    {
        return $this->hasMany(HolidayRequest::className(), ['employee_pk' => 'employee_pk'])
            ->where('approved = :approved', ['approved' => true])
            ->orderBy('holiday_request_pk');
    }

    public function getUnapprovedRequests()
    {
        return $this->hasMany(HolidayRequest::className(), ['employee_pk' => 'employee_pk'])
            ->where('approved = :approved', ['approved' => false])
            ->orderBy('holiday_request_pk');
    }

    public function getValidRequests()
    {
        return $this->hasMany(HolidayRequest::className(), ['employee_pk' => 'employee_pk'])
            ->where("cancelled = :cancelled AND to_char(start_date, 'YYYY') = to_char(now(), 'YYYY')", ['cancelled' => false])
            ->orderBy('holiday_request_pk');
    }

    public function getEmployeeInfo()
    {
        return $this->hasOne(EmployeeInfo::className(), ['employee_pk' => 'employee_pk']);
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['department_pk' => 'department_pk']);
    }

    public function getMyDepartments()
    {
        return $this->hasMany(Department::className(), ['manager_id' => 'employee_pk']);
    }

    public function getAllowances()
    {
        return $this->hasMany(HolidayAllowance::className(), ['employee_pk' => 'employee_pk']);
    }

    public function getRole()
    {
        return $this->hasOne(Role::className(), ['emp_role_pk' => 'role_id']);
    }

    public static function loadToArray($emp)
    {

        if ($emp) {
            $user = $emp->attributes;
        } else {
            return null;
        }

        $user_arr = [
            'id' => $user['employee_pk'],
            'username' => $user['username'],
            'password' => $user['password'],
            'authKey' => 'key' . $user['password'],
            'accessToken' => 'token' . $user['password'],
            'role' => $user['role_id']
        ];
        return $user_arr;
    }

}