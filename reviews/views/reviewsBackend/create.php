<?php
    $this->breadcrumbs = array(        
        Yii::t($this->aliasModuleT, 'Reviews') => array($this->patchBackend.'index'),
        Yii::t($this->aliasModuleT, 'Create'),
    );

    $this->pageTitle = Yii::t($this->aliasModuleT, 'Reviews - create');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t($this->aliasModuleT, 'Reviews management'), 'url' => array($this->patchBackend.'index')),
        array('icon' => 'plus-sign', 'label' => Yii::t($this->aliasModuleT, 'Create article'), 'url' => array($this->patchBackend.'create')),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'Reviews'); ?>
        <small><?php echo Yii::t($this->aliasModuleT, 'create'); ?></small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
    'aliasModuleT' => $this->aliasModuleT,
)); ?>