<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 02.02.2019
 * Time: 10:05
 */

namespace app\models;


use yii\db\ActiveRecord;

class HolidayType extends ActiveRecord
{
    public static function tableName()
    {
        return 'holiday_type';
    }

    public static function allAsArray(){
        $all = self::find()->all();
        $ret = [];
        foreach ($all as $item){
            $ret[$item->holiday_type] = $item->holiday_type;
        }
        return $ret;
    }
}