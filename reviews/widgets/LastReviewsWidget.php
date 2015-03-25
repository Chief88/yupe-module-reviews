<?php

Yii::import('application.modules.reviews.models.*');

class LastReviewsWidget extends yupe\widgets\YWidget{

    public $view = 'lastReviewsWidget';

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->limit = (int)$this->limit;
        $criteria->order = 'id DESC';

        $reviews = Reviews::model()->published()->cache($this->cacheTime)->findAll($criteria);

        $this->render($this->view, array('models' => $reviews));
    }
}