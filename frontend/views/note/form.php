<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->label('用户名')->textInput() ?>

    <?= $form->field($model, 'pwd')->label('密码')->textInput() ?>

    <?= $form->field($model, 'status')->label('状态')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->flag==0?'Submit':'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
