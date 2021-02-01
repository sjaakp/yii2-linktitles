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
 */

namespace sjaakp\linktitles;

use yii\web\AssetBundle;

class LinkTitlesAsset extends AssetBundle {
    public $sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';

    public $js = [
        'linktitles.js'
    ];
}
