<?php
namespace common\components ;
use Yii ;

class MediaHelper
{
  public static function getImageUrl($image)
  {
    if($image)
      return Yii::$app->params['uploadDirWeb'] . $image ;
    else
      return Yii::$app->params['defaultPhoto'];
  }
  public static function getImagePath($image)
  {
    return Yii::$app->params['uploadDir'] . $image ;
  }
}