<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/9
 * Time: 下午4:52
 */

namespace app\modules\services\daemon\process;
use app\modules\apis\IDAllocApi;
use app\modules\models\beans\QuestionDetailBean;
use app\modules\models\beans\QuestionRecordBean;
use app\modules\models\question\QuestionDetailModel;
use app\modules\models\question\QuestionRecordModel;
use sp_framework\components\SpLog;

class CreateQuestionDetailService
{
    public static function execute($processName, $minID){
        $id = $minID;
        while(true){
            $questionRecordBeanList = QuestionRecordModel::queryWaitWorkToQuestionDetailRecordList($id, $processName);
            if(empty($questionRecordBeanList)){
                break;
            }

            foreach($questionRecordBeanList as $questionRecordBean){
                $id = $questionRecordBean->getID();
                do{
                    $explodeResult = self::explodeQuestionRecord($questionRecordBean, $processName);
                    if(!$explodeResult){
                        SpLog::warning("解析失败,数据为:" . json_encode($questionRecordBean->toArray()));
                        sleep(1);
                    }
                }while(!$explodeResult);
            }
        }
    }

    private static function explodeQuestionRecord(QuestionRecordBean $questionRecordBean, $name){
        $updateRowNum = QuestionRecordModel::updateWorkStatusToProcessing($questionRecordBean, $name);
        if($updateRowNum <= 0){
            return true;
        }
        $jsonWorkContent    = $questionRecordBean->getWorkContent();
        $workContent        = json_decode($jsonWorkContent, true);
        $questionList       = $workContent['questList'];
        $condition          = $workContent['condition'];
        $idResponse         = IDAllocApi::batch(count($questionList));
        if(empty($idResponse['data'])){
            return false;
        }
        $uuidList           = explode(',', $idResponse['data']);
        $allDone            = true;
        $i = 0;
        foreach($questionList as $questionInfo){
            $questionDetailBeanData = [
                'uuid'                      => $uuidList[$i++],
                'question_record_id'        => $questionRecordBean->getUuid(),
                'question_content'          => $questionInfo['question'] ?? "",
                'question_answer'           => $questionInfo['result']['answer'] ?? "",
                'question_analysis'         => $questionInfo['result']['analysis'] ?? "",
                'question_knowledge_point'  => $questionInfo['result']['knowledge_point'] ?? "",
                'question_question_point'   => $questionInfo['result']['question_point'] ?? "",
                'grade'                     => $condition['grade'],
                'subject'                   => $condition['subject'],
                'version'                   => $condition['version'],
                'module'                    => $condition['module'],
                'node_id'                   => $condition['node'],
                'question_type'             => $condition['questionType'],
                'create_time'               => date('Y-m-d H:i:s'),
            ];
            switch($questionInfo['result']['difficulty']){
                case "基础题":{
                    $questionDetailBeanData['difficulty'] = 1;
                    break;
                }
                case "中档题":{
                    $questionDetailBeanData['difficulty'] = 2;
                    break;
                }
                case "较难题":{
                    $questionDetailBeanData['difficulty'] = 3;
                    break;
                }
                default:{
                    $questionDetailBeanData['difficulty'] = $condition['difficulty'];
                }
            }
            $questionDetailBean = new QuestionDetailBean($questionDetailBeanData);
            $insertResult       = QuestionDetailModel::insertOneRecord($questionDetailBean, $name);
            if($insertResult <= 0){
                $allDone = false;
            }
        }
        if($allDone){
            QuestionRecordModel::updateWorkStatusToDone($questionRecordBean, $name);
        }
        return true;
    }
}