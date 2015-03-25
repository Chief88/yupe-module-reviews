<?php
    $this->breadcrumbs = array(        
        Yii::t($this->aliasModuleT, 'Reviews') => array($this->patchBackend.'index'),
        $model->fio => array($this->patchBackend.'view', 'id' => $model->id),
        Yii::t($this->aliasModuleT, 'Edit'),
    );

    $this->pageTitle = Yii::t($this->aliasModuleT, 'Reviews - edit');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t($this->aliasModuleT, 'Reviews management'), 'url' => array($this->patchBackend.'index')),
        array('icon' => 'plus-sign', 'label' => Yii::t($this->aliasModuleT, 'Create article'), 'url' => array($this->patchBackend.'create')),
        array('label' => Yii::t($this->aliasModuleT, 'Reviews Article') . ' «' . mb_substr($model->fio, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t($this->aliasModuleT, 'Edit reviews article'), 'url' => array(
            $this->patchBackend.'update/',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t($this->aliasModuleT, 'View reviews article'), 'url' => array(
            $this->patchBackend.'view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t($this->aliasModuleT, 'Remove reviews'), 'url' => '#', 'linkOptions' => array(
            'submit' => array($this->patchBackend.'delete', 'id' => $model->id),
            'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
            'confirm' => Yii::t($this->aliasModuleT, 'Do you really want to remove the article?'),
            'csrf' => true,
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t($this->aliasModuleT, 'Edit reviews article'); ?><br />
        <small>&laquo;<?php echo $model->fio; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
    'aliasModuleT' => $this->aliasModuleT,
)); ?>
