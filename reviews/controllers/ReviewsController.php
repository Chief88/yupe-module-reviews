<?php

class ReviewsController extends yupe\components\controllers\FrontController{

    public   $aliasModule = 'ReviewsModule.reviews';
    public   $patchBackend = '/reviews/reviewsBackend/';
    
    public function actionIndex()
    {
        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params'    => [
                ':status' => Reviews::STATUS_PUBLISHED,
            ],
            'order'     => 't.date DESC',
        ]);


        $dataProvider = new CActiveDataProvider('Reviews', [
            'criteria' => $dbCriteria,
            'pagination'=>[
              'pageSize'=>$this->module->perPage,
            ],
        ]);

        $categoryModel = '';
        if (\Yii::app()->hasModule('category')) {
            $categoryModel = \Category::model()->findByAttributes(['slug' => 'stranica-otzyvy']);
        }

        $this->render('index', [
            'categoryModel' => $categoryModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
