yii2-nestable
=============

Yii2 implementation for jquery.nestable plugin.
Plugin sources homepage: http://dbushell.github.io/Nestable/

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require slatiusa/yii2-nestable "dev-master"
```

or add

```
"slatiusa/yii2-nestable": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

```
use slatiusa\nestable\Nestable;

echo Nestable::widget([
    'type' => Nestable::TYPE_WITH_HANDLE,
    'items' => [
        ['content' => 'Item # 1', 'id' => 1],
        ['content' => 'Item # 2', 'id' => 2],
        ['content' => 'Item # 3', 'id' => 3],
        ['content' => 'Item # 4 with children', 'id' => 4, 'children' => [
            ['content' => 'Item # 4.1', 'id' => 5],
            ['content' => 'Item # 4.2', 'id' => 6],
            ['content' => 'Item # 4.3', 'id' => 7],
        ]],
    ],
    'pluginEvents' => [
        'change' => 'function(e) {
            var list   = e.length ? e : $(e.target);
            console.log( JSON.stringify( list.nestable("serialize") ) );
        }',
    ],
    'pluginOptions' => [
        'maxDepth' => 7,
    ],
]);

```