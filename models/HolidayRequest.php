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

    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['employee_pk' => 'employee_pk']);
    }

    public function getApprover()
    {
        return $this->hasOne(Employee::className(), ['employee_pk' => 'approved_by']);
    }

    public function getCanceller()
    {
        return $this->hasOne(Employee::className(), ['employee_pk' => 'cancelled_by']);
    }

    public function approve() {
        // only manager of requestor can approve
        $approver = \Yii::$app->user->getIdentity()->getId();
        if ($this->employee->department->manager_id == $approver) {
            if (!$this->cancelled) {
                $this->approved = true;
                $this->approved_by = $approver;
                return $this->save();
            }
        }
    }

    public function cancel() {
        // only requestor or manager of requestor can cancel
        $approver = \Yii::$app->user->getIdentity()->getId();
        $manager = $this->employee->department->manager_id;

        if ($this->employee_pk == $approver || $manager == $approver) {
            $this->cancelled = true;
            $this->cancelled_by = $approver;
            return $this->save();
        }
    }

}