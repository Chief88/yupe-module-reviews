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
              'pageSize'=>10,
            ],
        ]);
        $this->render('index', ['dataProvider' => $dataProvider]);
    }
}
