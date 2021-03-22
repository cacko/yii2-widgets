<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$exception = Yii::$app->errorHandler->exception;

?>
<div class="site-error">

    <div class="terminal-alert terminal-alert-error">
        <code>
            <pre>
            <?= print_r($exception) ?>
            </pre>
        </code>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>