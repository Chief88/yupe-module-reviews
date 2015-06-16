<?php

Yii::import('application.modules.reviews.models.*');

class LastReviewsWidget extends yupe\widgets\YWidget{

    public $view = 'lastReviewsWidget';
    public $onHome = false;

    public function run()
    {
        $criteria = new CDbCriteria();
        if ($this->onHome) {
            $criteria->condition = 'on_home = :onHome';
            $criteria->params = [
                ':onHome' => 1
            ];
        }
        $criteria->limit = (int)$this->limit;
        $criteria->order = 'id DESC';

        $reviews = Reviews::model()->published()->cache($this->cacheTime)->findAll($criteria);

        $this->render($this->view, ['models' => $reviews]);
    }
}