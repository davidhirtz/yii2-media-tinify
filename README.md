README
============================

This extension enables the Tinify API, used for [TinyPNG](https://tinypng.com) and [TinyJPG](https://tinyjpg.com), to compresses images for the [Yii 2](http://www.yiiframework.com/) extension [yii2-media](https://github.com/davidhirtz/yii2-media/) by David Hirtz. 

Read more at [http://tinify.com](http://tinify.com).

### Installation

```
composer require davidhirtz/yii2-media-tinify
```

### Setup

Add your TinyPNG API key to `config/params.php` or use command line script:

```
php yii params/create tinifyApiKey "YOUR-TINYPNG-KEY"
```

```php
<?php
return [
    'tinifyApiKey' => 'YOUR-TINYPNG-KEY',
];
```