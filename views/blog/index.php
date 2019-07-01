<?php

use yii\helpers\Html;
use app\assets\BlogAsset;
use yii\widgets\ActiveForm;

BlogAsset::register($this);
?>

<h1>Блог</h1>
<div class="col-md-4">
    <div class="form">
        <?php $form = ActiveForm::begin(['action' => 'blog/add']); ?>
        <fieldset>
            <legend>Форма для отправки сообщения</legend>
            <p><?= $form->field($message, 'author')->textInput()->label('Имя') ?></p>
            <p><?= $form->field($message, 'message')->textarea()->label('Сообщение') ?></p>
            <p><?= $form->field($message, 'file')->fileInput()->label('Файл') ?></p>
            <p><?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-primary']) ?></p>
        </fieldset>
        <?php ActiveForm::end() ?>
    </div>
</div>

<div class="col-md-8">
    <?php foreach ($messages as $message):?>
        <div class="message">
            <p><b>Имя пользователя: </b><?= Html::encode($message->author) ?></p>
            <p><b>Дата отправки сообщения: </b><?= $message->getDate() ?></p>
            <p><b>Текст сообщения: </b><?= Html::encode($message->message) ?></p>
            <?php if (!empty($message->path_to_file)):?>
                <p><?= Html::img($message->path_to_file, ['alt' => 'Изображение', 'height' => '100']) ?></p>
            <?php endif;?>
        </div>
    <?php endforeach;?>
</div>