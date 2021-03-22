<?php

use app\modules\video\models\Video;
use Cacko\Yii2\Widgets\Video\Widgets\VideoWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\VideoForm */


$startTimestampInputId = Html::getInputId($model, 'startTimestamp');
$startTimeInputId = Html::getInputId($model, 'startTime');
$startTimestamp = $model->startTimestamp;


$urlInputId = Html::getInputId($model, 'url');
Pjax::begin(['id' => 'video-form']);

$this->registerJs('
(function () {
    const startTimestamp = ' . $model->startTimestamp . ' * 1000;
    const $startTime = $("#' . $startTimeInputId . '");
    const $startTimestampInputId = $("#' . $startTimestampInputId . '");
    const startTime = moment(startTimestamp || null);
    $startTime.on("change", function() {
        const d = moment($(this).val(), moment.HTML5_FMT.TIME_SECONDS);
        $startTimestampInputId.val(d.isValid() ? d.format("X"): 0);
    });
    $startTime.val(startTimestamp && startTime.isValid() ? startTime.format("HH:mm:ss") : "");
    const countdown = $("#countdown");
    const countdownInterval = setInterval(() => {
        const timeleft = Math.round(Math.max(0, startTimestamp - (new Date()).getTime()) / 1000);
        if (!timeleft) {
            clearInterval(countdownInterval);
            countdown.remove();
        }
        countdown.text(`in ${timeleft}s`);
    }, 1000);
  })();
');

?>
<?php if ($model->validate()) : ?>
    <section>
        <div class="terminal-card">
            <header>Video <span id="countdown"></span></header>
            <?= VideoWidget::widget($model->toArray()) ?>
        </div>
    </section>
<?php endif; ?>
<section>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true,]
    ]); ?>
    <fieldset>
        <div class="collapse show" data-url>
            <?= $form->field($model, 'url')
                ->label('Url (click for examples)', ['data-toggle' => 'collapse', 'data-target' => '[data-url]']) ?>
        </div>
        <div id="examples" class="collapse" data-url>
            <?= $form->field($model, 'exampleUrl')
                ->dropDownList(
                    Video::getDefaultVideos(),
                    [
                        'prompt' => 'Pick some shit...',
                        'onchange' => "$('#{$urlInputId}').val($(this).val());$(this).val('');$('[data-url]').collapse('toggle');"
                    ]
                )
            ?>
        </div>
        <div class="form-row">
            <div class=" col">
                <?= $form->field($model, 'autoPlay')->checkbox() ?>
            </div>
            <div class=" col">
                <?= $form->field($model, 'hideControls')->checkbox() ?>
            </div>
            <div class=" col">
                <?= $form->field($model, 'openInModal')->checkbox() ?>
            </div>
            <div class=" col">
                <?= $form->field($model, 'loop')->checkbox() ?>
            </div>
        </div>
        <div class="form-row">
            <div class=" col">
                <?= $form->field($model, 'startTime', ['inputOptions' => ['type' => 'time', 'step' => 1]]) ?>
                <?= Html::activeHiddenInput($model, 'startTimestamp') ?>
            </div>
            <div class=" col">
                <?= $form->field($model, 'startPosition', ['inputOptions' => ['type' => 'number', 'min' => 0]]) ?>
            </div>
        </div>
        <div class="form-row">
            <div class=" col">
                <?= $form->field($model, 'placeholderImage') ?>
            </div>
        </div>
        <div class="form-row">
            <div class=" col">
                <?= $form->field($model, 'placeholderEndImage') ?>
            </div>
        </div>
        <div class="form-row justify-content-center">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>
    </fieldset>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</section>