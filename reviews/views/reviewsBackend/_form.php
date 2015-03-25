<?php

$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id' => 'eviews-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'type' => 'vertical',
        'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
    )
); ?>
<div class="alert alert-info">
    <?php echo Yii::t($aliasModuleT, 'Fields with'); ?>
    <span class="required">*</span>
    <?php echo Yii::t($aliasModuleT, 'are required'); ?>
</div>

<?php echo $form->errorSummary($model); ?>

<div class="row">

    <div class="col-xs-2 <?php echo $model->hasErrors('status') ? 'error' : ''; ?>">
        <?php echo $form->dropDownListGroup(
            $model,
            'status',
            array(
                'widgetOptions' => array(
                    'data' => $model->getStatusList(),
                ),
            )
        ); ?>
    </div>

    <div class="col-xs-2 <?php echo $model->hasErrors('rating') ? 'error' : ''; ?>">
        <?php echo $form->dropDownListGroup(
            $model,
            'rating',
            array(
                'widgetOptions' => array(
                    'data' => $model->getRatingList(),
                    'htmlOptions' => array(
                        'empty'  => '--Выбрать--',
                        'encode' => false
                    ),
                ),
            )
        ); ?>
    </div>

</div>

<div class="row">
    <div class="col-xs-7">
        <?php echo $form->textFieldGroup($model, 'fio'); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-7">
        <?php echo $form->textFieldGroup($model, 'organisation'); ?>
    </div>
</div>

<div class='row'>
    <div class="col-sm-7">
        <?php
        echo CHtml::image(
            !$model->isNewRecord && $model->image ? $model->getImageUrl() : '#',
            $model->fio,
            array(
                'class' => 'preview-image',
                'style' => !$model->isNewRecord && $model->image ? '' : 'display:none'
            )
        );  ?>
        <?php echo $form->fileFieldGroup(
            $model,
            'image',
            array(
                'widgetOptions' => array(
                    'htmlOptions' => array(
                        'onchange' => 'readURL(this);',
                        'style'    => 'background-color: inherit;'
                    )
                )
            )
        ); ?>
    </div>
</div>

<div class="row">
    
    <div class="col-xs-12 <?php echo $model->hasErrors('message') ? 'has-error' : ''; ?>">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php $this->widget(
            $this->module->getVisualEditor(),
            array(
                'model'     => $model,
                'attribute' => 'message',
            )
        ); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>
    
</div>

<br/>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType' => 'submit',
        'context'    => 'primary',
        'label'      => $model->isNewRecord ? Yii::t($aliasModuleT, 'Create article and continue') : Yii::t(
            $aliasModuleT,
            'Save reviews article and continue'
        ),
    )
); ?>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'buttonType'  => 'submit',
        'htmlOptions' => array('name' => 'submit-type', 'value' => 'index'),
        'label'       => $model->isNewRecord ? Yii::t($aliasModuleT, 'Create article and close') : Yii::t(
            $aliasModuleT,
            'Save reviews article and close'
        ),
    )
); ?>

<?php $this->endWidget(); ?>
