<?php

use yupe\components\WebModule;

class ReviewsModule extends WebModule
{
    const VERSION = '0.9';

    public $uploadPath        = 'reviews';
    public $allowedExtensions = 'jpg,jpeg,png,gif';
    public $minSize           = 0;
    public $maxSize           = 52428800;
    public $maxFiles          = 1;
    public $perPage           = 4;

    private  $aliasModule = 'ReviewsModule.reviews';
    private  $patchBackend = '/reviews/reviewsBackend/';

    public function getInstall()
    {
        if (parent::getInstall()) {
            @mkdir(Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath, 0755);
        }

        return false;
    }

    public function checkSelf()
    {
        $messages = [];

        $uploadPath = Yii::app()->uploadManager->getBasePath() . DIRECTORY_SEPARATOR . $this->uploadPath;

        if (!is_writable($uploadPath))
            $messages[WebModule::CHECK_ERROR][] =  [
                'type'    => WebModule::CHECK_ERROR,
                'message' => Yii::t($this->aliasModule, 'Directory "{dir}" is not accessible for write! {link}', [
                    '{dir}'  => $uploadPath,
                    '{link}' => CHtml::link(Yii::t($this->aliasModule, 'Change settings'), [
                        '/yupe/backend/modulesettings/',
                        'module' => 'reviews',
                     ]),
                ]),
            ];

        return (isset($messages[WebModule::CHECK_ERROR])) ? $messages : true;
    }

    public function getParamsLabels()
    {
        return [
            'mainCategory'      => Yii::t($this->aliasModule, 'Main reviews category'),
            'adminMenuOrder'    => Yii::t($this->aliasModule, 'Menu items order'),
            'editor'            => Yii::t($this->aliasModule, 'Visual Editor'),
            'uploadPath'        => Yii::t($this->aliasModule, 'Uploading files catalog (relatively {path})', ['{path}' => Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . Yii::app()->getModule("yupe")->uploadPath]),
            'allowedExtensions' => Yii::t($this->aliasModule, 'Accepted extensions (separated by comma)'),
            'minSize'           => Yii::t($this->aliasModule, 'Minimum size (in bytes)'),
            'maxSize'           => Yii::t($this->aliasModule, 'Maximum size (in bytes)'),
            'perPage'           => Yii::t($this->aliasModule, 'Reviews per page'),
        ];
    }

    public function getEditableParams()
    {
        return [
            'adminMenuOrder',
            'editor'       => Yii::app()->getModule('yupe')->getEditors(),
            'mainCategory' => CHtml::listData($this->getCategoryList(),'id','name'),
            'uploadPath',
            'allowedExtensions',
            'minSize',
            'maxSize',
            'perPage',
        ];
    }

    public function getEditableParamsGroups()
    {
        return [
            'main' => [
                'label' => Yii::t($this->aliasModule, 'General module settings'),
                'items' => [
                    'adminMenuOrder',
                    'editor',
                    'mainCategory'
                ]
            ],
            'images' => [
                'label' => Yii::t($this->aliasModule, 'Images settings'),
                'items' => [
                    'uploadPath',
                    'allowedExtensions',
                    'minSize',
                    'maxSize'
                ]
            ],
            'list' => [
                'label' => Yii::t($this->aliasModule, 'Reviews lists'),
                'items' => [
                    'perPage',
                ],
            ],
        ];
    }

    public function getVersion()
    {
        return self::VERSION;
    }

    public function getIsInstallDefault()
    {
        return true;
    }

    public function getCategory()
    {
        return Yii::t($this->aliasModule, 'Content');
    }

    public function getName()
    {
        return Yii::t($this->aliasModule, 'Reviews');
    }

    public function getDescription()
    {
        return Yii::t($this->aliasModule, 'Module for creating and management reviews');
    }

    public function getAuthor()
    {
        return Yii::t($this->aliasModule, 'Sergey Latyshkov');
    }

    public function getAuthorEmail()
    {
        return Yii::t($this->aliasModule, 'serg.latyshkov@gmail.com');
    }

    public function getUrl()
    {
        return Yii::t($this->aliasModule, 'https://github.com/Chief88/yupe-module-reviews');
    }

    public function getIcon()
    {
        return "fa fa-fw fa-comments-o";
    }

    public function getAdminPageLink()
    {
        return $this->patchBackend.'index';
    }

    public function getNavigation()
    {
        return [
            ['icon' => 'fa fa-fw fa-list-alt',
                'label' => Yii::t($this->aliasModule, 'Reviews list'),
                'url' => [$this->patchBackend.'index']
            ],
            ['icon' => 'fa fa-fw fa-plus-square',
                'label' => Yii::t($this->aliasModule, 'Create reviews'),
                'url' => [$this->patchBackend.'create']
            ],
        ];
    }

    public function init()
    {
        parent::init();

        $this->setImport([
            'reviews.models.*'
        ]);
    }

    public function getAuthItems()
    {
        return [
            [
                'name'        => 'Reviews.ReviewsManager',
                'description' => Yii::t($this->aliasModule, 'Manage reviews'),
                'type'        => AuthItem::TYPE_TASK,
                'items'       => [
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'reviews.reviewsBackend.Create',
                        'description' => Yii::t($this->aliasModule, 'Creating reviews')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'reviews.reviewsBackend.Delete',
                        'description' => Yii::t($this->aliasModule, 'Removing reviews')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'reviews.reviewsBackend.Index',
                        'description' => Yii::t($this->aliasModule, 'List of reviews')
                    ],
                    [
                        'type'        => AuthItem::TYPE_OPERATION,
                        'name'        => 'reviews.reviewsBackend.Update',
                        'description' => Yii::t($this->aliasModule, 'Editing reviews')
                    ],
                ]
            ]
        ];
    }
}