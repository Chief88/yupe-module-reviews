<?php

class ReviewsBackendController extends yupe\components\controllers\BackController{

    public   $aliasModule = 'ReviewsModule.reviews';
    public   $patchBackend = '/reviews/reviewsBackend/';

    public function actions()
    {
        return [
            'inline' => [
                'class' => 'yupe\components\actions\YInLineEditAction',
                'model' => 'Reviews',
                'validAttributes' => ['fio', 'status', 'rating', 'organisation', 'on_home']
            ],
            'toggle' => [
                'class'     => 'booster.actions.TbToggleAction',
                'modelName' => 'Reviews',
            ],
        ];
    }

    /**
     * Manages all models.
     *
     * @return void
     */
    public function actionIndex()
    {
        $model = new Reviews('search');

        $model->unsetAttributes(); // clear any default values

        $model->setAttributes(
            Yii::app()->getRequest()->getParam(
                'Reviews', []
            )
        );

        $this->render('index', ['model' => $model]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Reviews();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (($data = Yii::app()->getRequest()->getPost('Reviews')) !== null) {
            
            $model->setAttributes($data);

            if ($model->save()) {
                
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t($this->aliasModule, 'Reviews article was created!')
                );

                $this->redirect(
                    (array) Yii::app()->getRequest()->getPost(
                        'submit-type', ['create']
                    )
                );
            }
        }

        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (($data = Yii::app()->getRequest()->getPost('Reviews')) !== null) {
            
            $model->setAttributes($data);

            if ($model->save()) {

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t($this->aliasModule, 'Reviews article was updated!')
                );

                $this->redirect(
                    Yii::app()->getRequest()->getIsPostRequest()
                        ? (array) Yii::app()->getRequest()->getPost(
                            'submit-type', ['update', 'id' => $model->id]
                        )
                        : ['view', 'id' => $model->id]
                );
            }
        }

        $this->render(
            'update',[
                'model'      => $model,
            ]
        );
    }

    public function actionDelete($id = null)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            
            $this->loadModel($id)->delete();
            
            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t($this->aliasModule, 'Record was removed!')
            );

            // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
            Yii::app()->getRequest()->getParam('ajax') !== null || $this->redirect(
                (array) Yii::app()->getRequest()->getPost('returnUrl', 'index')
            );
        } else {
            throw new CHttpException(
                400,
                Yii::t($this->aliasModule, 'Bad request. Please don\'t use similar requests anymore!')
            );
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * 
     * @param integer the ID of the model to be loaded
     *
     * @return void
     *
     * @throws CHttpException If record not found
     */
    public function loadModel($id)
    {
        if (($model = Reviews::model()->findByPk($id)) === null) {
            throw new CHttpException(
                404,
                Yii::t($this->aliasModule, 'Requested page was not found!')
            );
        }
        
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * 
     * @param CModel the model to be validated
     *
     * @return void
     */
    protected function performAjaxValidation(Reviews $model)
    {
        if (Yii::app()->getRequest()->getIsAjaxRequest() && Yii::app()->getRequest()->getPost('ajax') === 'reviews-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}