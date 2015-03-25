<?php

class ReviewsController extends yupe\components\controllers\FrontController{

    public   $aliasModuleT = 'ReviewsModule.reviews';
    public   $patchBackend = '/reviews/reviewsBackend/';
    
    public function actionIndex()
    {
        $dbCriteria = new CDbCriteria(array(
            'condition' => 't.status = :status',
            'params'    => array(
                ':status' => Reviews::STATUS_PUBLISHED,
            ),
            'order'     => 't.date DESC',
        ));


        $dataProvider = new CActiveDataProvider('Reviews', array(
            'criteria' => $dbCriteria,
            'pagination'=>array(
              'pageSize'=>10,
            ),
        ));
        $this->render('index', array('dataProvider' => $dataProvider));
    }
}
