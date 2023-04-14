<?php

namespace App\Controller\User;

use App\Controller\AppController;

class AccountsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Cms');
        // $this->setHeadTitle('お知らせ');
    }

    public function index()
    {
        // $this->getTableLocator('Accounts');

        if ($this->request->is('post')) {

            $data = $this->request->getData();


            $this->modelName = 'Accounts';
            $entity = $this->fetchTable('Accounts')->newEntity($this->request->getData(), ['validate' => 'login']);

            
            if (empty($entity->getErrors())) {
                $login = $this->Accounts->find('all')->where(['Accounts.login_id' => $data['login_id']])->first();

                // $face_image = $r->face_image ? $r->attaches['face_image']['s'] : '';
                if ($login) {
                    if ($data['password'] == @$login['password']) {
                        $this->Session->write([
                            'user_data' => [
                                'name' => $login['username'],
                                'account_type' => $login['account_type'],
                                // 'face_image' => $face_image
                            ],
                        ]);
                        return $this->redirect('/');
                    } else $this->set('err', 'Sorry, Mật khẩu không đúng.');
                } else $this->set('err', 'Sorry, Tài khoản không tồn tại.');
            } else $this->set('err', $entity->getErrors());
        }
    }
}
