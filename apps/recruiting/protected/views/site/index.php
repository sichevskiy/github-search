<?php

?>
    <div class="form">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'edit-form',
            'htmlOptions' => array(
                'class' => 'well',
                'onsubmit' => '$("#loading").show()',
            ),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <div class="row">
            <?php echo $form->textFieldRow($model, 'location'); ?>
            <?php echo $form->textFieldRow($model, 'language'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Show', array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php if (!empty($users)) { ?>

    <h2>Total count: <?php echo $totalCount; ?></h2>

    <?php

    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $users,
        'template' => "{pager}{items}{pager}",
        'columns' => array(
            array(
                'header' => 'User',
                'type' => 'raw',
                'value' => function ($data) {
                    $result = CHtml::image($data['avatar_url'], 'ava', array('width' => 50, 'height' => 50, 'margin-right' => 5));
                    $result .= CHtml::link($data['login'], $data['html_url']);

                    $result .= CHtml::form(Yii::app()->createUrl('site/username'));
                    $result .= CHtml::hiddenField('RecruitingForm[username]', $data['login']);
                    $result .= CHtml::submitButton('Check');
                    $result .= CHtml::endForm();

                    return $result;
                },
            ),
        ),
    ));
    ?>

<?php } ?>