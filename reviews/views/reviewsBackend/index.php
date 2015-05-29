<?php

$this->breadcrumbs = [
        Yii::t($this->aliasModule, 'Reviews') => [$this->patchBackend.'index'],
        Yii::t($this->aliasModule, 'Management'),
    ];

    $this->pageTitle = Yii::t($this->aliasModule, 'Reviews - management');

    $this->menu = [
        [
            'icon' => 'list-alt',
            'label' => Yii::t($this->aliasModule, 'Reviews management'),
            'url' => [$this->patchBackend.'index']
        ],
        [
            'icon' => 'plus-sign',
            'label' => Yii::t($this->aliasModule, 'Create article'),
            'url' => [$this->patchBackend.'create']
        ],
    ];
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModule, 'Reviews'); ?>
        <small><?php echo Yii::t($this->aliasModule, 'management'); ?></small>
    </h1>
</div>

<p><?php echo Yii::t($this->aliasModule, 'This section describes Reviews Management'); ?></p>

<?php $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'reviews-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            [
                'name'        => 'id',
                'htmlOptions' => ['style' => 'width:20px'],
                'type'  => 'raw',
                'value' => 'CHtml::link($data->id, ["'. $this->patchBackend .'update", "id" => $data->id])',
            ],
            [
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name'  => 'fio',
                'editable' => [
                    'url' => $this->createUrl($this->patchBackend.'inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'filter'   => CHtml::activeTextField($model, 'fio', ['class' => 'form-control']),
            ],
            [
                'class' => 'bootstrap.widgets.TbEditableColumn',
                'name'  => 'organisation',
                'editable' => [
                    'url' => $this->createUrl($this->patchBackend.'inline'),
                    'mode' => 'inline',
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'filter'   => CHtml::activeTextField($model, 'organisation', ['class' => 'form-control']),
            ],
            [
                'class'  => 'bootstrap.widgets.TbEditableColumn',
                'editable' => [
                    'url'  => $this->createUrl($this->patchBackend.'inline'),
                    'mode' => 'popup',
                    'type' => 'select',
                    'title'  => Yii::t($this->aliasModule, 'Select {field}', ['{field}' => mb_strtolower($model->getAttributeLabel('rating'))]),
                    'source' => $model->getRatingList(),
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'name'   => 'rating',
                'type'   => 'raw',
                'value'  => '$data->getRating()',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'rating',
                    $model->getRatingList(),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '']
                )
            ],
            'date',
            [
                'class'  => 'bootstrap.widgets.TbEditableColumn',
                'editable' => [
                    'url'  => $this->createUrl($this->patchBackend.'inline'),
                    'mode' => 'popup',
                    'type' => 'select',
                    'title'  => Yii::t($this->aliasModule, 'Select {field}', ['{field}' => mb_strtolower($model->getAttributeLabel('status'))]),
                    'source' => $model->getStatusList(),
                    'params' => [
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    ]
                ],
                'name'   => 'status',
                'type'   => 'raw',
                'value'  => '$data->getStatus()',
                'filter' => CHtml::activeDropDownList(
                    $model,
                    'status',
                    $model->getStatusList(),
                    ['class' => 'form-control', 'encode' => false, 'empty' => '']
                )
            ],
            [
                'class'                => '\yupe\widgets\ToggleColumn',
                'name'                 => 'on_home',
                'checkedButtonLabel'   => Yii::t($this->aliasModule, 'yes'),
                'uncheckedButtonLabel' => Yii::t($this->aliasModule, 'no'),
                'filter'               => $model->getOnHomeList(),
            ],
            [
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template'    => '{update}{delete}',
            ],
        ],
    ]
); ?>