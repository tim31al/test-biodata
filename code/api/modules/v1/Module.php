<?php

namespace api\modules\v1;


/**
 * Class Module
 */
class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->controllerNamespace = 'api\modules\v1\controllers';
    }
}
