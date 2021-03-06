<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/1/12
 * Time: 下午7:29
 */

namespace app\modules\commands;
use app\modules\components\MockData;
use app\modules\constants\RedisKey;
use app\modules\library\Proxy;
use app\modules\services\daemon\process\CreateQuestionDetailService;
use app\modules\services\daemon\process\TurnMathmlToPngService;
use app\modules\services\daemon\spider\CreateQuestionService;
use app\modules\services\daemon\spider\GetProxyIPListService;
use rrxframework\util\RedisUtil;
use sp_framework\components\SpLog;
use yii\console\Controller;

class MainController extends Controller
{
    public function actionIndex($subjectName, $processIndex, $startNodeID){
        set_time_limit(0);
        $record = MockData::getTestRecord();
        CreateQuestionService::foreachQuestionList($record, $subjectName, $startNodeID);
    }

    public function actionGetSelfProxyIpList(){
        set_time_limit(0);
        $redis = RedisUtil::getInstance('redis');
        while(true){
            $miPuIPList = GetProxyIPListService::getMiPuIpList();
            $miPuIPList = array_unique($miPuIPList);
            $selfIPList = Proxy::getSelfProxyIPList($miPuIPList);
            SpLog::notice('self ip list is:' . implode(',', $selfIPList));
            foreach($selfIPList as $selfIP){
                $redis->sadd(RedisKey::SELF_PROXY_IP_LIST, $selfIP);
            }
            sleep(60);
        }
    }

    public function actionGetSelfSpiderProxyIpList(){
        set_time_limit(0);
        $redis = RedisUtil::getInstance('redis');
        while(true){
            $kuaiIPList = GetProxyIPListService::getProxyIPList('kuai');
            $yunIPList  = GetProxyIPListService::getProxyIPList('yun');
            $xiCiIPList = GetProxyIPListService::getProxyIPList('xi_ci');
            $ipList     = array_merge($kuaiIPList, $yunIPList, $xiCiIPList);
            $ipList     = array_unique($ipList);
            $selfIPList = Proxy::getSelfProxyIPList($ipList);
            foreach($selfIPList as $selfIP){
                $redis->sadd(RedisKey::SELF_PROXY_IP_LIST, $selfIP);
            }
            sleep(5);
        }
    }

    public function actionCreateQuestionDetail($processName = "", $minID = 0){
        set_time_limit(0);
        CreateQuestionDetailService::execute($processName, $minID);
    }

    public function actionTurnMathmlToPng($processName, $minID = 0){
        set_time_limit(0);
        TurnMathmlToPngService::execute($processName, $minID);
    }

    public function actionCreateNodeList(){
        set_time_limit(0);
        $record = MockData::getTestRecord();
    }
}
