<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 20.01.2019
 * Time: 11:00
 */

/**
 * @var $employee \app\models\Employee
 */

echo '<h2>Profile</h2>';
Yii::$app->session->getFlash('error');
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
                        <?= $employee->employeeInfo->first_name ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Last name:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee->employeeInfo->last_name ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Birth date:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee->employeeInfo->birth_date ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Address:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee->employeeInfo->address ?>
                    </div>
                </div>
                <div class="row help-block">
                    <div class="col-lg-3">
                        <b>Job title:</b>
                    </div>
                    <div class="col-lg-3">
                        <?= $employee->job_id ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-1">
    </div>


    <div class="col-lg-5">
        <div class="row login-details">
            <div class="col-lg-12">
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
        <a href="?r=site%2Fchange-password" type="button" id="change_pass" class="btn btn-primary edit-btn">Change password</a>
            </div>
        </div>
    </div>

</div>
