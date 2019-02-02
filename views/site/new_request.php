<?php
/**
 * Created by PhpStorm.
 * User: C0RRUP70R
 * Date: 20.01.2019
 * Time: 10:55
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

echo '<h2>New Request</h2>';
?>
<div class="row">
    <div class="col-lg-5">

        <?php
        Yii::$app->session->getFlash('success');
        $form = ActiveForm::begin([
            'id' => 'new-request',
        ]); ?>
        <?= $form->field($model, 'type')->dropDownList($types); ?>
        <?= $form->field($model, 'start_date')->widget(\kartik\date\DatePicker::className()); ?>
        <?= $form->field($model, 'end_date')->widget(\kartik\date\DatePicker::className()); ?>
        <div class="form-group">
            <div class="col-lg-11">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

