<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 11.01.2019
 * Time: 20:37
 */

namespace app\models;


use yii\db\ActiveRecord;

class HolidayAllowance extends ActiveRecord
{
    public static function tableName()
    {
        return "holiday_allowance";
    }

}