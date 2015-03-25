<?php

$this->breadcrumbs = array(
        Yii::t($this->aliasModuleT, 'Reviews') => array($this->patchBackend.'index'),
        Yii::t($this->aliasModuleT, 'Management'),
    );

    $this->pageTitle = Yii::t($this->aliasModuleT, 'Reviews - management');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t($this->aliasModuleT, 'Reviews management'), 'url' => array($this->patchBackend.'index')),
        array('icon' => 'plus-sign', 'label' => Yii::t($this->aliasModuleT, 'Create article'), 'url' => array($this->patchBackend.'create')),
    );
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'Reviews'); ?>
        <small><?php echo Yii::t($this->aliasModuleT, 'management'); ?></small>
    </h1>
</div>

<p><?php echo Yii::t($this->aliasModuleT, 'This section describes Reviews Management'); ?></p>

<?php $this->widget('yupe\widgets\CustomGridView', array(
    'id'           => 'reviews-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        array(
            'name'        => 'id',
            'htmlOptions' => array('style' => 'width:20px'),
            'type'  => 'raw',
            'value' => 'CHtml::link($data->id, array("'. $this->patchBackend .'update", "id" => $data->id))',
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name'  => 'fio',
            'editable' => array(
                'url' => $this->createUrl($this->patchBackend.'inline'),
                'mode' => 'inline',
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            ),
            'filter'   => CHtml::activeTextField($model, 'fio', array('class' => 'form-control')),
        ),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name'  => 'organisation',
            'editable' => array(
                'url' => $this->createUrl($this->patchBackend.'inline'),
                'mode' => 'inline',
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            ),
            'filter'   => CHtml::activeTextField($model, 'organisation', array('class' => 'form-control')),
        ),
        array(
            'class'  => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'url'  => $this->createUrl($this->patchBackend.'inline'),
                'mode' => 'popup',
                'type' => 'select',
				'title'  => Yii::t($this->aliasModuleT, 'Select {field}', array('{field}' => mb_strtolower($model->getAttributeLabel('rating')))),
                'source' => $model->getRatingList(),
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            ),
            'name'   => 'rating',
            'type'   => 'raw',
            'value'  => '$data->getRating()',
            'filter' => CHtml::activeDropDownList(
                $model,
                'rating',
                $model->getRatingList(),
                array('class' => 'form-control', 'encode' => false, 'empty' => '')
            )
        ),
        array(
            'class'  => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'url'  => $this->createUrl($this->patchBackend.'inline'),
                'mode' => 'popup',
                'type' => 'select',
				'title'  => Yii::t($this->aliasModuleT, 'Select {field}', array('{field}' => mb_strtolower($model->getAttributeLabel('status')))),
                'source' => $model->getStatusList(),
                'params' => array(
                    Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                )
            ),
            'name'   => 'status',
            'type'   => 'raw',
            'value'  => '$data->getStatus()',
            'filter' => CHtml::activeDropDownList(
                $model,
                'status',
                $model->getStatusList(),
                array('class' => 'form-control', 'encode' => false, 'empty' => '')
            )
        ),
        'date',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'    => '{update}{delete}',
        ),
    ),
)); ?>