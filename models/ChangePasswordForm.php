<?php
/**
 * Created by PhpStorm.
 * User: Lenka
 * Date: 02.02.2019
 * Time: 9:04
 */

namespace app\models;


use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    public $old_pass;
    public $new_pass;
    public $new_pass_2;

    public function rules()
    {
        return array(
            array(array('old_pass', 'new_pass', 'new_pass_2'), 'required'),
            array('new_pass','match', 'pattern' => '/^(?=.*[0-9])(?=.*[A-Z])([a-zA-Z0-9]+)$/)'),
            // array('new_pass, new_pass_2', 'length', 'min'=>8, 'max'=>40),
            array('new_pass_2', 'compare', 'compareAttribute' => 'new_pass', 'message' => 'Does not match with New password'),
        );
    }

    public function checkAndChange()
    {
        $employee = Employee::findOne(Yii::$app->user->getIdentity()->getId());

        if ($employee->password == md5($this->old_pass)) {
            if ($this->old_pass != $this->new_pass && $this->new_pass == $this->new_pass_2) {
                $employee->password = md5($this->new_pass);

                return $employee->save();
            }
        }

        return false;
    }

}