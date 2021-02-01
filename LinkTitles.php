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
 * Widget for Yii 2.x
 */

namespace sjaakp\linktitles;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class LinkTitles
 * @package sjaakp\linktitles
 */
class LinkTitles extends Widget
{
    /**
     * @var array HTML options of the surrounding <div>
     */
    public $options = [];

    public $className = 'link-titles';

    public $action = 'link-title';

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        $view = $this->getView();

        $asset = new LinkTitlesAsset();
        $asset->register($view);

        $view->registerJs("linktitles('.$this->className','$this->action');");

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        Html::addCssClass($this->options, $this->className);

        echo Html::beginTag('div', $this->options);
    }

    /**
     * @return string
     */
    public function run()
    {
        return '</div>';
    }
}