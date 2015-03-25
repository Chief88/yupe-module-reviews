<?php
Yii::import('application.modules.reviews.models.Reviews');

class AllReviewsWidget extends yupe\widgets\YWidget{

    public $countInLine = 3;

    public function init(){

    }

    public function run(){

        $this->registerScripts();
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';

        $reviews = Reviews::model()->published()->cache($this->cacheTime)->findAll($criteria);

        $this->render('//allReviewsWidgetViews', array(
            'reviews'       => $reviews,
            'countInLine'   => $this->countInLine,
        ));

    }

    public function registerScripts()
    {
        $assets = Yii::getPathOfAlias('application.modules.reviews.widgets.AllReviewsWidget.assets');
        $baseUrl = Yii::app()->assetManager->publish($assets);

        if(is_dir($assets)){
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerCssFile($baseUrl . '/css/allReviewsWidget.css');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/js/allReviewsWidget.js', CClientScript::POS_END);
        }

    }


}