Yii2-LinkTitles
===============
[![Latest Stable Version](https://poser.pugx.org/sjaakp/yii2-linktitles/v/stable)](https://packagist.org/packages/sjaakp/yii2-linktitles)
[![Total Downloads](https://poser.pugx.org/sjaakp/yii2-linktitles/downloads)](https://packagist.org/packages/sjaakp/yii2-linktitles)
[![License](https://poser.pugx.org/sjaakp/yii2-linktitles/license)](https://packagist.org/packages/sjaakp/yii2-linktitles)

**LinkTitles** is a [Yii 2.0](https://www.yiiframework.com/ "Yii") widget which adds titles to relative links. 
The titles will pop up in a toolbox window when hovering above the link.
The titles are fetched from the site by means of JSON-calls.
If the link already has a title, it will remain unchanged, and not be overwritten by **LinkTitles**. 

A demonstration of the LinkTitles is [here](http://www.sjaakpriester.nl/software/linktitles).

## Installation ##

Install **yii2-linktitles** in the usual way with [Composer](https://getcomposer.org/).
Add the following to the require section of your `composer.json` file:

`"sjaakp/yii2-linktitles": "*"`

or run:

`composer require sjaakp/yii2-linktitles`

You can manually install **yii2-linktitles** by [downloading the source in ZIP-format](https://github.com/sjaakp/yii2-linktitles/archive/master.zip).

## Prerequisites ##

For **LinkTitles** to work, some settings have to be done to the `urlManager` component
in the site's main configuration file, usually called `web.php` or `main.php` in the `config`
directory:

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<c:[\w\-]+>/<id:\d+>' => '<c>/view',
                // other rules ...
            ],
            // ...

Many Yii 2 sites will have these settings anyway.

## Using the LinkTitles widget ##

Using the **LinkTitles** widget in an Yii2 view file can be as simple as:

    <?php
    use sjaakp\linktitles\LinkTitles;
    ?>
        ...
        <?php LinkTitles::begin() ?>
            <p>Some HTML containing several relative links... </p>
        <?php LinkTitles::end() ?>
        ... 

The HTML between `begin()` and `end()` can be as complicated as you like.

On loading the view, **LinkTitles** tries to retrieve the titles of 
all the relative links by means of a JSON call with a modified `href`.
If the `href` of the link is `/message/42`, **LinkTitles** calls
`/message/link-title/42`. 
The site is expected to return the title in JSON-format, like:

    { "title": "The title of Message 42" }

One way to accomplish this is by using `LinkTitleAction` to add an action
`link-title` to the controller linked to, like so:

    <?php
    use sjaakp\linktitles\LinkTitleAction;
    use yii\web\Controller;
    use app\models\Message;
    
    class MessageController extends Controller
    {
        ...
        public function actions()
        {
            return [
                'link-title' => [
                    'class' => LinkTitleAction::class,
                    'model' => Message::class
                ]
            ];
        }
        ...
    }
    ?>

This assumes that the model (`Message`) has an attribute `title` which 
contains the link title.

If the link title is kept in another attribute, say `header`,
set the `attribute` property of `LinkTitleAction` to its name, like so:

        public function actions()
        {
            return [
                'link-title' => [
                    'class' => LinkTitleAction::class,
                    'model' => Message::class,
                    'attribute' => 'header'
                ]
            ];
        }

You may also write a custom function to handle the `link-title` function
along these lines:

    <?php

    class MessageController extends Controller
    {
        ...
        public function actionLinkTitle($id)
        {
            $model = Message::findOne($id);
            if ($model) {
                $title = <retrieve title from $model>
                $r = [ 'title' => $title ];
            }
            else $r = [];
            return $this->asJson($r);
        }
        ...
    }
