<?php
    $this->breadcrumbs = [
        Yii::t($this->aliasModule, 'Reviews') => [$this->patchBackend.'index'],
        $model->name => [$this->patchBackend.'view', 'id' => $model->id],
        Yii::t($this->aliasModule, 'Edit'),
    ];

    $this->pageTitle = Yii::t($this->aliasModule, 'Reviews - edit');

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
        ['label' => Yii::t($this->aliasModule, 'Reviews Article') . ' «' . mb_substr($model->name, 0, 32) . '»'],
        [
            'icon' => 'pencil',
            'label' => Yii::t($this->aliasModule, 'Edit reviews article'),
            'url' => [
                $this->patchBackend.'update/',
                'id' => $model->id
            ]
        ],
        [
            'icon' => 'trash',
            'label' => Yii::t($this->aliasModule, 'Remove reviews'),
            'url' => '#', 'linkOptions' => [
                'submit' => [$this->patchBackend.'delete', 'id' => $model->id],
                'params' => [Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken],
                'confirm' => Yii::t($this->aliasModule, 'Do you really want to remove the article?'),
                'csrf' => true,
            ]
        ],
    ];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModule, 'Edit reviews article'); ?><br />
        <small>&laquo;<?php echo $model->name; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', [
    'model' => $model,
    'aliasModule' => $this->aliasModule,
]); ?>
