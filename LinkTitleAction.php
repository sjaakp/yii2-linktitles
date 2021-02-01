<?php
/**
 * sjaakp/yii2-linktitles
 * ----------
 * Add title to relative links in PHP-framework Yii 2.x
 * Version 1.0
 * Copyright (c) 2021
 * Sjaak Priester, Amsterdam
 * MIT License
 * https://github.com/sjaakp/yii2-linktitles
 * https://sjaakpriester.nl
 *
 * Action for Yii 2.x
 */

namespace sjaakp\linktitles;

use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * Class LinkTitleAction
 * @package sjaakp\taggable
 */
class LinkTitleAction extends Action
{
    /**
     * @var ActiveRecord
     * Classname of the model
     */
    public $model;

    /**
     * @var string
     * The attribute to return as link title.
     */
    public $attribute = 'title';

    /**
     * @inheritDoc
     */
    public function run($id)  {
        if (is_null($this->model))   {
            throw new InvalidConfigException('LinkTitles: property "model" is not set.');
        }

        $contr = $this->controller;
        $m = $this->model::findOne($id);
        $r = $m ? ['title' => $m->getAttribute($this->attribute)] : [];
        return $contr->asJson($r);
    }
}
