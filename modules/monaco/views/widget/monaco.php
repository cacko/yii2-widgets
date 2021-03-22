<?php

use app\modules\monaco\models\Script;
use Cacko\Yii2\Widgets\FullScreen\components\Options;
use Cacko\Yii2\Widgets\FullScreen\FullScreenAsset;
use Cacko\Yii2\Widgets\MonacoEditor\MonacoEditorAsset;
use Cacko\Yii2\Widgets\MonacoEditor\Widget\Editor as MonacoEditor;
use Cacko\Yii2\Widgets\MonacoEditor\Widget\DiffEditor as MonacoDiffEditor;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii as Yii;
use app\modules\monaco\assets\ModuleAsset;
use yii\web\View;

/**
 * @var Script $model
 * @var UploadForm $formModel
 */

/** @var Options  */
$fullScreenOptions = Yii::createObject(Options::class);


FullScreenAsset::register($this);
ModuleAsset::register($this, View::PH_BODY_END);

$targetClasses = array_map(fn ($class) => '.' . $class, [MonacoEditor::getTargetClass(), MonacoDiffEditor::getTargetClass()]);

$iconUpload = Html::tag('i', '', ['class' => ['icon-widgets-upload-outline'], 'data-toggle' => 'collapse']);
$iconMinimize = Html::tag('i', '', ['class' => ['icon-widgets-window-minimize'], 'data-toggle' => 'collapse']);
$iconFullScreen = Html::tag('i', '', ['class' => [$fullScreenOptions->iconExpand, $fullScreenOptions->classToggle]]);

$cardHeader = fn ($title, $icons = []) => Html::tag(
    'header',
    join('', [
        Html::tag('span', Html::encode($title), ['class' => 'title']),
        count($icons) === 1 ? join('', $icons) : Html::tag('div', join('', $icons), ['class'  => 'float-right'])
    ])
);
?>

<div id="module-vars" data-fullscreen-target="<?= join(', ', $targetClasses) ?>" data-editor="#editor" data-diff="#diff-view" style="display: none">
</div>

<section>
    <div class="terminal-card editor" id="upload-form">
        <?= $cardHeader('upload', [$iconUpload]) ?>
        <div class="collapse">
            <?php Pjax::begin([
                'id' => 'upload-monaco', 'timeout' => 3000, 'enablePushState' => true,     'enablePushState' => false,
                'enableReplaceState' => false, 'clientOptions' => ['maxCacheLength' => 0]
            ]); ?>
            <?= $this->render('form', ['model' => $model, 'formModel' => $formModel]) ?>
        </div>
</section>
<?php if ($model && !Yii::$app->request->isAjax) : ?>
    <section>
        <div class="terminal-card editor">
            <?= $cardHeader($model->name, [$iconMinimize, $iconFullScreen]) ?>
            <div class="collapse show">
                <?= MonacoEditor::widget([
                    'model' => $model,
                    'attribute' => 'script',
                    'language' => $model->type,
                    'theme' => MonacoEditorAsset::THEME_DARK,
                    'id' => 'editor',
                ]) ?>
            </div>
        </div>
    </section>
    <section>
        <div class="terminal-card">
            <?= $cardHeader('diff viewer', [$iconMinimize, $iconFullScreen]) ?>
            <div class="collapse show">
                <?= MonacoDiffEditor::widget([
                    'model' => $model,
                    'parent' => $model,
                    'attribute' => 'script',
                    'lineNumbers' => true,
                    'language' => $model->type,
                    'id' => 'diff-view'
                ]) ?>
            </div>
        </div>
    </section>
<?php endif; ?>