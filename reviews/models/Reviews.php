<?php

class Reviews extends yupe\models\YModel{

    const STATUS_DRAFT      = 0;
    const STATUS_PUBLISHED  = 1;
    const STATUS_MODERATION = 2;

    const PROTECTED_NO  = 0;
    const PROTECTED_YES = 1;

    private  $aliasModuleT = 'ReviewsModule.reviews';

    public function tableName()
    {
        return '{{reviews_reviews}}';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels(){

        return array(
            'id'            => Yii::t($this->aliasModuleT, 'Id'),
            'date'          => Yii::t($this->aliasModuleT, 'Date'),
            'fio'           => Yii::t($this->aliasModuleT, 'Fio'),
            'organisation'  => Yii::t($this->aliasModuleT, 'Organisation'),
            'image'         => Yii::t($this->aliasModuleT, 'Image'),
            'message'       => Yii::t($this->aliasModuleT, 'Message'),
            'rating'        => Yii::t($this->aliasModuleT, 'Rating'),
            'status'        => Yii::t($this->aliasModuleT, 'Status'),
        );

    }

    public function rules()
    {
        return array(
            array('fio, message, organisation', 'filter', 'filter' => 'trim'),
            array('fio', 'filter', 'filter' => array(new CHtmlPurifier(), 'purify')),
            array('fio, message', 'required', 'on' => array('update', 'insert')),
            array('status, rating', 'numerical', 'integerOnly' => true),
            array('fio, organisation', 'length', 'max' => 150),
            array('status', 'in', 'range' => array_keys($this->getStatusList())),
            array('rating', 'in', 'range' => array_keys($this->getRatingList())),
            array('id, date, fio, message, status, organisation, image, rating', 'safe', 'on' => 'search'),
        );
    }

    public function behaviors()
    {
        $module = Yii::app()->getModule('reviews');

        return array(
            'imageUpload' => array(
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'scenarios'     => array('insert', 'update'),
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
            ),
        );
    }

    public function relations()
    {
        return array(

        );
    }

    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status = :status',
                'params'    => array(':status'   => self::STATUS_PUBLISHED),
            ),
            'recent'    => array(
                'order' => 'date DESC',
                'limit' => 5,
            )
        );
    }

    public function search(){

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('fio', $this->fio, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('organisation', $this->organisation, true);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function getRatingList(){

        return array(
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        );

    }

    public function getStatusList()
    {
        return array(
            self::STATUS_DRAFT      => Yii::t($this->aliasModuleT, 'Draft'),
            self::STATUS_PUBLISHED  => Yii::t($this->aliasModuleT, 'Published'),
            self::STATUS_MODERATION => Yii::t($this->aliasModuleT, 'On moderation'),
        );
    }

    public function getRating()
    {
        $data = $this->getRatingList();
        return isset($data[$this->rating]) ? $data[$this->rating] : Yii::t($this->aliasModuleT, '*unknown*');
    }

    public function getStatus()
    {
        $data = $this->getStatusList();
        return isset($data[$this->status]) ? $data[$this->status] : Yii::t($this->aliasModuleT, '*unknown*');
    }

}