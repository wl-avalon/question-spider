<?php
/**
 * Created by PhpStorm.
 * User: wzj-dev
 * Date: 18/2/24
 * Time: 上午11:09
 */

namespace app\modules;

class Module extends \yii\base\Module {
    public function init() {
        $class = get_class($this);
        $pos = strrpos($class, '\\');
        $this->controllerNamespace = substr($class, 0, $pos) . '\\commands';
    }
}
