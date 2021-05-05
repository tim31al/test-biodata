<?php

namespace api\modules\v1\models;


class User extends \common\models\FbUser
{
    public function fields()
    {
        return [
            'id',
            'created' => function () {
                return date(\DATE_ATOM, $this->created_at);
            },
            'bonus' => function () {
                return (string) $this->bonus;
            },
        ];
    }

}
