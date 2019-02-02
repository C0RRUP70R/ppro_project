<?php
/**
 * Created by PhpStorm.
 * User: Lenka
 * Date: 02.02.2019
 * Time: 8:58
 */

//$form = ActiveForm::begin(); //Default Active Form begin
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $model \app\models\ChangePasswordForm
 */

?>
<div class="row">
    <div class="col-lg-6">


<?php
$form = ActiveForm::begin([
    'id' => 'active-form',
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data'
    ],
]);
echo '<h2>Change password</h2>';
echo $form->field($model, 'old_pass')->passwordInput()
    ->label('Old password');
echo $form->field($model, 'new_pass')->passwordInput()
    ->hint('Password must have at least 8 characters; must contain at least one lowercase letter, one uppercase letter, one numeric digit, and cannot contain whitespace')
    ->label('New password');
echo $form->field($model, 'new_pass_2')->passwordInput()
    ->label('Repeat password');

echo '<div id="show_pass">';
echo Html::checkbox('reveal-password', false, ['id' => 'reveal-password']);
echo Html::label('Show password', 'reveal-password');
echo '</div>';

echo Html::submitButton('Submit', ['class'=> 'btn btn-primary']);
ActiveForm::end();

?>
    </div>
<?php
$this->registerJs(
        "jQuery('#reveal-password').change(function(){
        jQuery('#changepasswordform-new_pass_2').attr('type',this.checked?'text':'password');
        jQuery('#changepasswordform-new_pass').attr('type',this.checked?'text':'password');
        })");
?>