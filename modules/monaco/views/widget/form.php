<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\Pjax;

?>

<?php Pjax::begin([
    'id' => 'upload-monaco', 'timeout' => 3000, 'clientOptions' => ['maxCacheLength' => 0]
]); ?>

<?php if (Yii::$app->request->isPjax) : ?>
    <?= $this->registerJs("
        $('#editor').closest('.terminal-card').find('span.title').html(" . Json::htmlEncode($model->name) . ");
        $('#editor').monacoEditor('loadNew', " . Json::htmlEncode($model->script) . ", " . Json::encode($model->type) . ");
        $('#diff-view').monacoDiffEditor('loadNew', " . Json::htmlEncode($model->script) . ", " . Json::htmlEncode($model->script) . ", " . Json::encode($model->type) . ");
        $('#upload-form .collapse').toggleClass('show');") ?>
<?php endif; ?>

<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]) ?>
<fieldset>
    <div class="form-row">
        <div class="col justify-content-center">
            <?= $form->field($formModel, 'file')->fileInput()->label('Upload your own file.') ?>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
</fieldset>
<?php ActiveForm::end() ?>
<?php Pjax::end(); ?>