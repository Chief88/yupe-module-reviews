<?php
/**
 * Reviews install migration
 * Класс миграций для модуля Reviews
 **/
class m000000_000000_reviews_base extends yupe\components\DbMigration
{

    public function safeUp(){

        $this->createTable(
            '{{reviews_reviews}}',
            [
                'id' => 'pk',
                'name' => 'varchar(250) NOT NULL',
                'organisation' => 'varchar(250) NOT NULL',
                'rating' => "integer NOT NULL",
                'status' => "integer NOT NULL DEFAULT '0'",
                'date' => 'timestamp NOT NULL',
                'image' => 'varchar(300) DEFAULT NULL',
                'message' => 'text NOT NULL',
                'on_home' => "integer NOT NULL DEFAULT '0'",
            ], $this->getOptions()
        );

    }
 

    public function safeDown()
    {
        $this->dropTableWithForeignKeys('{{reviews_reviews}}');
    }
}