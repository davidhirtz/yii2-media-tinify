<?php

namespace davidhirtz\yii2\media\tinify\composer;

use davidhirtz\yii2\media\models\Transformation;
use davidhirtz\yii2\media\s3\Module;
use davidhirtz\yii2\skeleton\composer\BootstrapTrait;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Yii;
use yii\base\ModelEvent;
use yii\debug\models\search\Event;

/**
 * Class Bootstrap
 * @package davidhirtz\yii2\media\tinify\composer
 */
class Bootstrap implements BootstrapInterface
{
    use BootstrapTrait;

    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        Event::on(Transformation::EVENT_AFTER_FIND, function (ModelEvent $event) {
            Yii::debug($event->sender);
        });
    }
}