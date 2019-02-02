<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 02.02.2019
 * Time: 9:34
 */

namespace app\models;


use yii\base\Model;

class NewRequestForm extends Model
{
    public $type;
    public $start_date;
    public $end_date;

    public function rules()
    {
        return [
            [['type', 'start_date', 'end_date'], 'required'],
            ['start_date', 'date', 'timestampAttribute' => 'start_date'],
            ['end_date', 'date', 'timestampAttribute' => 'end_date'],
            ['end_date', 'compare', 'compareAttribute' => 'start_date', 'operator' => '>=']
        ];
    }

    public function createRequest()
    {
        $employee = Employee::findOne(\Yii::$app->user->getIdentity()->getId());
        $start = new \DateTime($this->start_date);
        $end = new \DateTime($this->end_date);
        $duration = (strtotime($this->end_date) - strtotime($this->start_date)) / (60*60*24)+1;
        $allowance = HolidayAllowance::find()->where(['employee_pk' => $employee->employee_pk, 'holiday_type' => $this->type, 'year' => $start->format('Y')])->one();
        $sum = 0;
        foreach ($employee->validRequests as $item) {
            $sum += $item->duration;
        }
        if ($sum + $duration <= $allowance->total) {
            $holiday_request = new HolidayRequest();
            $holiday_request->employee_pk = $employee->employee_pk;
            $holiday_request->start_date = $start->format('Y-m-d');
            $holiday_request->end_date = $end->format('Y-m-d');
            $holiday_request->duration = $duration;
            $holiday_request->holiday_type = $this->type;
            return $holiday_request->save();
        }
        return false;
    }

}