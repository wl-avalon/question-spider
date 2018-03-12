<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/3/2
 * Time: 下午4:21
 */

namespace app\modules\services\daemon\process;

class CreateNodeListService
{
    public static function createNodeList($record){
        foreach($record as $gradeKey => $xueKeData){
            $xueKeList      = $xueKeData['data'];
            foreach($xueKeList as $subjectKey => $banBenData){
                $subjectChinese = $banBenData['value'];
                $banBenList     = $banBenData['data'];
                foreach($banBenList as $versionKey => $moduleData){
                    $mokuaiList = $moduleData['data'];
                    foreach($mokuaiList as $moduleKey => $module){
                        $nodeList           = $module['data']['nodeList'];
                        $difficultyMap      = $module['data']['nanDuMap'];
                        $questionTypeMap    = $module['data']['tiXingMap'];
                        foreach($nodeList as $nodeItem){
                            $nodeID = $nodeItem['id'];
                            if(!$start && $nodeID != $startNodeID){
                                continue;
                            }else{
                                $start = true;
                            }
                            foreach($difficultyMap as $difficultyKey => $difficulty){
                                foreach($questionTypeMap as $questionTypeKey => $questionType){
                                    self::createQuestionRecordList($gradeKey, $subjectKey, $versionKey, $moduleKey, $nodeID, $difficultyKey, $questionTypeKey, $subjectChinese);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}