<?php
Yii::import('application.modules.reviews.models.Reviews');

class LeaveReviewFormWidget extends CWidget{

    public $model;

    public function init(){

    }

    public function run(){

        $this->registerScripts();

        $this->render('//leaveReviewFormWidgetViews', array(
            'model' => $this->model,
        ));

    }

    public function registerScripts()
    {
        $assets = Yii::getPathOfAlias('application.modules.reviews.widgets.LeaveReviewFormWidget.assets');
        $baseUrl = Yii::app()->assetManager->publish($assets);

        if(is_dir($assets)){
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/leaveReviewFormWidget.js', CClientScript::POS_END);
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/leaveReviewFormWidget.css');
        }

    }


}