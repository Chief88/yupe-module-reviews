<?php

class Reviews extends yupe\models\YModel{

    const STATUS_DRAFT      = 0;
    const STATUS_PUBLISHED  = 1;
    const STATUS_MODERATION = 2;

    const PROTECTED_NO  = 0;
    const PROTECTED_YES = 1;

    const ON_HOME_NO  = 0;
    const ON_HOME_YES  = 1;

    private  $aliasModule = 'ReviewsModule.reviews';

    public function tableName()
    {
        return '{{reviews_reviews}}';
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function attributeLabels(){

        return [
            'id'            => Yii::t($this->aliasModule, 'Id'),
            'date'          => Yii::t($this->aliasModule, 'Date'),
            'name'           => Yii::t($this->aliasModule, 'name'),
            'organisation'  => Yii::t($this->aliasModule, 'Organisation'),
            'image'         => Yii::t($this->aliasModule, 'Image'),
            'message'       => Yii::t($this->aliasModule, 'Message'),
            'rating'        => Yii::t($this->aliasModule, 'Rating'),
            'status'        => Yii::t($this->aliasModule, 'Status'),
            'on_home'       => Yii::t($this->aliasModule, 'On home page'),
            'email'       => Yii::t($this->aliasModule, 'E-mail'),
        ];

    }

    public function rules()
    {
        return [
            ['name, message, organisation', 'filter', 'filter' => 'trim'],
            ['name', 'filter', 'filter' => [new CHtmlPurifier(), 'purify']],
            ['email, name, message', 'required',
                'on' => ['update', 'insert'],
                'message' => 'Ошибка'
            ],
            ['on_home, status, rating', 'numerical',
                'integerOnly' => true,
                'message' => 'Ошибка'
            ],
            ['organisation', 'length',
                'max' => 150,
                'message' => 'Ошибка'
            ],
            ['name',
                'match',
                'pattern' => '/^[АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя A-Za-z-]{2,50}$/',
                'message' => 'Ошибка'
            ],
			['message', 'length',
                'max' => 500,
                'message' => 'Ошибка'
            ],
            ['email',
                'email',
                'message' => 'Ошибка'
            ],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['rating', 'in', 'range' => array_keys($this->getRatingList())],
            ['on_home', 'in', 'range' => array_keys($this->getOnHomeList())],
            ['email, on_home, id, date, name, message, status, organisation, image, rating', 'safe', 'on' => 'search'],
        ];
    }

    public function behaviors()
    {
        $module = Yii::app()->getModule('reviews');

        return [
            'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'minSize'       => $module->minSize,
                'maxSize'       => $module->maxSize,
                'types'         => $module->allowedExtensions,
                'uploadPath'    => $module->uploadPath,
                'resizeOptions' => [
                    'width'   => 9999,
                    'height'  => 9999,
                    'quality' => [
                        'jpegQuality'         => 100,
                        'pngCompressionLevel' => 10
                    ],
                ],
                'defaultImage'   => $module->getAssetsUrl() . '/img/nophoto.jpg',
            ]
        ];
    }

    public function relations()
    {
        return [

        ];
    }

    public function scopes()
    {
        return [
            'published' => [
                'condition' => 't.status = :status',
                'params'    => [':status'   => self::STATUS_PUBLISHED],
            ],
            'recent'    => [
                'order' => 'date DESC',
                'limit' => 5,
            ]
        ];
    }

    public function search(){

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('message', $this->message, true);
        $criteria->compare('organisation', $this->organisation, true);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('status', $this->status);
        $criteria->compare('on_home', $this->on_home);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
        ]);
    }

    public function getRatingList(){

        return [
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];

    }

    public function getStatusList()
    {
        return [
            self::STATUS_DRAFT      => Yii::t($this->aliasModule, 'Draft'),
            self::STATUS_PUBLISHED  => Yii::t($this->aliasModule, 'Published'),
            self::STATUS_MODERATION => Yii::t($this->aliasModule, 'On moderation'),
        ];
    }

    public function getOnHomeList()
    {
        return [
            self::ON_HOME_YES      => Yii::t($this->aliasModule, 'yes'),
            self::ON_HOME_NO  => Yii::t($this->aliasModule, 'no'),
        ];
    }

    public function getRating()
    {
        $data = $this->getRatingList();
        return isset($data[$this->rating]) ? $data[$this->rating] : Yii::t($this->aliasModule, '*unknown*');
    }

    public function getStatus()
    {
        $data = $this->getStatusList();
        return isset($data[$this->status]) ? $data[$this->status] : Yii::t($this->aliasModule, '*unknown*');
    }

    public function getOnHome()
    {
        $data = $this->getOnHomeList();
        return isset($data[$this->on_home]) ? $data[$this->on_home] : Yii::t($this->aliasModule, '*unknown*');
    }

    public function getModelName()
    {
        return __CLASS__;
    }

}