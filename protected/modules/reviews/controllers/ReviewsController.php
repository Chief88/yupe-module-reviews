<?php
\Yii::import("ext.EAjaxUpload.qqFileUploader");
class ReviewsController extends yupe\components\controllers\FrontController{

    public   $aliasModule = 'ReviewsModule.reviews';
    public   $patchBackend = '/reviews/reviewsBackend/';
    
    public function actionIndex()
    {
        $this->processPageRequest('page');
        $this->_sendForm();

        $dbCriteria = new CDbCriteria([
            'condition' => 't.status = :status',
            'params'    => [
                ':status' => Reviews::STATUS_PUBLISHED,
            ],
            'order'     => 't.date DESC',
        ]);

        $dataProvider = new CActiveDataProvider('Reviews', [
            'criteria'=>$dbCriteria,
            'pagination'=>[
                'pageSize'=>$this->module->perPage,
                'pageVar' =>'page',
            ],
        ]);

        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loopAjax', [
                'dataProvider'=>$dataProvider,
            ]);
            Yii::app()->end();
        } else {
            $categoryModel = \Category::model()->findByAttributes( ['slug' => 'stranica-otzyvy']);

            $this->render('index', [
                'dataProvider'=>$dataProvider,
                'categoryModel'=>$categoryModel,
            ]);
        }
    }

    protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
    }

    private function _sendForm(){

        $form = new \Reviews();
        $module = \Yii::app()->getModule('reviews');

        // если пользователь авторизован - подставить его данные
        if (\Yii::app()->user->isAuthenticated()) {
            $form->email = \Yii::app()->getUser()->getProFileField('email');
            $form->name = \Yii::app()->getUser()->getProFileField('nick_name');
        }

        if (\Yii::app()->getRequest()->getIsPostRequest() && !empty($_POST[$form->getModelName()])) {

            $form->setAttributes(\Yii::app()->getRequest()->getPost($form->getModelName()));

            if ($form->validate()) {
                if ($form->save()) {

                    \Yii::app()->mailMessage->sendTemplate('ostavlen-novyy-otzyv',[
                        '[[siteName]]' => \Yii::app()->name,
                    ]);

                    if (\Yii::app()->getRequest()->getIsAjaxRequest()) {
                        \Yii::app()->ajax->success(\Yii::t($this->aliasModule, 'Your message sent! Thanks!'));
                    }

                    \Yii::app()->getUser()->setFlash(
                        \yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,'Спасибо, ваше сообщение отправлено!'
                    );

                    $this->redirect(['/reviews']);
                }else{
                    if (\Yii::app()->getRequest()->getIsAjaxRequest()) {
                        \Yii::app()->ajax->failure(\Yii::t($this->aliasModule, 'It is not possible to send message!'));
                    }

                    \Yii::app()->getUser()->setFlash(
                        \yupe\widgets\YFlashMessages::ERROR_MESSAGE,'Прроизошла ошибка. Попробуйте еще раз или обратитесь в тех. поддержку.'
                    );
                }
            } else {
                if (\Yii::app()->getRequest()->getIsAjaxRequest()) {
                    \Yii::app()->ajax->rawText(CActiveForm::validate($form));
                }
            }
        }

        \Yii::app()->session['aReviews'] = [
            'form' => $form,
            'module' => $module
        ];

    }
}
