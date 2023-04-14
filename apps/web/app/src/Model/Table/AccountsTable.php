<?php

namespace App\Model\Table;

use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class AccountsTable extends AppTable
{
    public function validationlogin(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('login_id', 'Vui lòng nhập ID đăng nhập.')
            ->maxLength('login_id',  50, __('50字以内で入力してください'))
            ->notEmptyString('password', 'Vui lòng nhập Password.')
            ->maxLength('password',  50, __('50字以内で入力してください'));

        return $validator;
    }
}
