<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/23
 * Time: 下午3:57
 */

namespace app\modules\components;


use app\modules\models\beans\QuestionDetailBean;

class PackageParams
{
    const IMAGE_DIR_PATH = '/home/saber/webroot/image';

    public static function getContentMathMlFileName($dirPath, $index){
        return "{$dirPath}/content_{$index}.mml";
    }

    public static function getAnswerMathMlFileName($dirPath, $index){
        return "{$dirPath}/answer_{$index}.mml";
    }

    public static function getAnalysisMathMlFileName($dirPath, $index){
        return "{$dirPath}/analysis_{$index}.mml";
    }

    public static function getContentPNGFileName($dirPath, $index){
        return "{$dirPath}/content_{$index}.png";
    }

    public static function getAnswerPNGFileName($dirPath, $index){
        return "{$dirPath}/answer_{$index}.png";
    }

    public static function getAnalysisPNGFileName($dirPath, $index){
        return "{$dirPath}/analysis_{$index}.png";
    }

    public static function getImageDirPath(QuestionDetailBean $questionDetailBean){
        return self::IMAGE_DIR_PATH . "/math-ml/{$questionDetailBean->getSubject()}/{$questionDetailBean->getVersion()}/{$questionDetailBean->getModule()}/{$questionDetailBean->getNodeID()}/{$questionDetailBean->getUuid()}";
    }

    public static function getContentWebPNGFileName($uuid, $index){
        return "/mathml/{$uuid}/content_{$index}.png";
    }

    public static function getAnswerWebPNGFileName($uuid, $index){
        return "/mathml/{$uuid}/answer_{$index}.png";
    }

    public static function getAnalysisWebPNGFileName($uuid, $index){
        return "/mathml/{$uuid}/analysis_{$index}.png";
    }
}