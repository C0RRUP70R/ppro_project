<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 20.01.2019
 * Time: 11:00
 */

/**
 * @var $employee \app\models\Employee
 * @var $employee_info \app\models\EmployeeInfo
 */

echo '<h2>Profile</h2>';

//echo '<pre>';
//foreach (\app\models\EmployeeInfo::find()->all() as $item)
//    print_r($item->attributes);
//echo '</pre>';
//
//echo \yii\grid\GridView::widget([
//    'dataProvider' => (new \app\models\EmployeeInfo())->getDataProvider()
//])
//;

//echo '<pre>';
//print_r(Yii::$app->user->getIdentity()->isAdmin());
//echo '</pre>';

//echo "<h3>Personal info</h3>";
//echo "<h4>$employee->username</h4>";
//echo "<h4>$employee->username</h4>";


?>


<div class="row">

    <div class="col-lg-5">
        <div class="row user-details">
            <div class="col-lg-12">
                <h3>User details</h3>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>First name:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee_info->first_name ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Last name:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee_info->last_name ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Birth date:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee_info->birth_date ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Address:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee_info->address ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-1">
    </div>


    <div class="col-lg-5">
        <div class="row login-details">
            <h3>Login details</h3>
            <div class="row help-block">
                <div class="col-lg-3">
                    <b>Login:</b>
                </div>
                <div class="col-lg-6">
                    <?= $employee->username ?>
                </div>
            </div>
            <div class="row help-block">
                <div class="col-lg-3">
                    <b>Last login:</b>
                </div>
                <div class="col-lg-6">
                    <?= $employee->last_login ?>
                </div>
            </div>

        </div>
        <button type="button" class="btn btn-primary edit-btn">Edit password</button>
    </div>

</div>
