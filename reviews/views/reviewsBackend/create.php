<?php
    $this->breadcrumbs = [
        Yii::t($this->aliasModule, 'Reviews') => [$this->patchBackend.'index'],
        Yii::t($this->aliasModule, 'Create'),
    ];

    $this->pageTitle = Yii::t($this->aliasModule, 'Reviews - create');

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
        <small><?php echo Yii::t($this->aliasModule, 'create'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', [
    'model' => $model,
    'aliasModule' => $this->aliasModule,
]); ?>