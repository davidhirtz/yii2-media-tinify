<?php

namespace davidhirtz\yii2\media\tinify\composer;

use davidhirtz\yii2\media\models\Transformation;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\ModelEvent;
use Yii;

use function Tinify\fromFile;
use function Tinify\setKey;

/**
 * Class Bootstrap
 * @package davidhirtz\yii2\media\tinify\composer
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * Overrides the default implementation of {@link Transformation::createTransformation()} by using the Tinify API to
     * manipulate the image. Tinify doesn't work on WEBP files.
     *
     * @param Application $app
     */
    public function bootstrap($app)
    {
        if (!empty($app->params['tinifyApiKey'])) {
            Event::on(Transformation::class, Transformation::EVENT_BEFORE_TRANSFORMATION, function (ModelEvent $event) {
                /** @var Transformation $transformation */
                $transformation = $event->sender;

                if (!$transformation->isWebp()) {
                    setKey(Yii::$app->params['tinifyApiKey']);

                    $image = fromFile($transformation->file->folder->getUploadPath() . $transformation->file->getFilename())->resize(array_filter([
                        'method' => $transformation->width && $transformation->height ? 'cover' : 'scale',
                        'width' => $transformation->width,
                        'height' => $transformation->height,
                    ]));

                    $transformation->size = $image->toFile($transformation->getFilePath());
                    $transformation->width = $image->result()->width();
                    $transformation->height = $image->result()->height();

                    $event->isValid = false;
                }
            });
        }
    }
}