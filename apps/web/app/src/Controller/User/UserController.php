<?php

namespace App\Controller;

use App\Form\ContactForm;

class UserController extends AppController
{


    // public function initialize(): void
    // {
    //     parent::initialize();
    //     $this->loadComponent('Cms');
    //     $this->setHeadTitle('お知らせ');
    // }

    public function accounts() {

    }

    var $uses = array('User');
    var $layout = "admin";
    // public function beforeFilter(){
    //     parent::beforeFilter();
    // }

    public function admin_login(){
        if($this->request->is('post')){
            if($this->Auth->login()){
                return $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->Session->setFlash('Username hoặc pass sai');
            }
        }
    }

    public function admin_logout(){
        $this->redirect($this->Auth->logout());
    }
    public function admin_list(){
        //Lay du lieu trong table users
        $array_user = $this->User->find('all', array(
            'conditions'=>array('id > 0'),
            'recursive'   =>-1
        ));
        //đưa dữ liệu lấy được qua view bằng biến users
        $this->set('users', $array_user);
    }
    public function admin_delete($id = null){
        if($this->request->is('get')){
            $data = $this->User->find('first', array(
                'fields' => array('id','name'),
                'conditions'=>array('id'=>$id),
                'recursive'=>-1
            ));
            if(!empty($data)){
                $this->Session->setFlash('Success');
                $this->User->delete($id);
            }else{
                $this->Session->setFlash('Error');
            }
            $this->redirect(array('action'=>'list'));
        }
    }
    public function admin_edit($id = null){
        if($this->request->is('post') || $this->request->is('put')){
            //print_r($this->request->data);exit();
            $this->User->id = $id;
            $this->User->set(array('date_updated' => date('Y:m:d H:i:s')));
            if($this->User->save($this->request->data)){
                $this->Session->setFlash('Success','default',array('class'=>"alert alert-success"));
                $this->redirect(array('action'=>'list'));
            }
        }else{
            $this->User->id = $id;
            $this->request->data = $this->User->read();//đọc thông tin user với $id, gán vào request->data hiển thị view
        }
    }
    public function admin_add(){
        $this->set('title_for_layout', 'Add user');
        if($this->request->is('post') || $this->request->is('put')){
            $now = date('Y:m:d H:i:s');
            $this->User->set(array('date_created'=>$now));
            $this->User->set(array('date_updated'=>$now));
            if($this->User->save($this->request->data)){
                $this->Session->setFlash('Success','default',array('class'=>"alert alert-success"));
                $this->redirect(array('action'=>'list'));
            }
        }
    }
    public function login(){
        $this->setLists();

    }
    public function loginFB(){
        $userData = array();
        $this->layout = 'ajax';
        $this->autoRender = false;
        $dataUserFB = json_decode($_POST['userData']);
        if(!empty($dataUserFB)){
            $userData['fb_id']          = $dataUserFB->id;
            $userData['name']           = $dataUserFB->first_name." ".$dataUserFB->last_name;
            $userData['email']          = $dataUserFB->email;
            $userData['avatar_face']    = "https://graph.facebook.com/".$userData['fb_id']."/picture?type=large";

            $now = date('Y:m:d H:i:s');
            $userData['date_created']   = $now;
            $userData['date_updated']   = $now;
            $userData['group_id']       = 3;
            $userDataInsert['User']     = $userData;

            dd($userData);
            $sql = "email like '%$dataUserFB->email%'";
            $data = $this->User->find('first', array(
                'fields' => array('id','email', 'name'),
                'conditions'=>array($sql),
                'recursive'   =>-1
            ));
            if(!empty($data)){
                $this->Session->write('User',$data);
                return json_encode($data);
            }else{
                if($this->User->save($userDataInsert)){
                    $this->Session->write('User',$userDataInsert);
                    return json_encode($userData);
                }else{
                    return false;
                }
            }
        }
    }
    function logout(){
        $this->Session->delete('User');
        $this->Session->destroy();
        $this->redirect('/accounts');
    }



    // public function index()
    // {
    //     $this->setLists();
    //     $this->set('slug', 'login');
    //     $this->loadModel('Accounts');

    //     if ($this->request->is('post')) {

    //         $data = $this->request->getData();
    //         $entity = $this->Accounts->newEntity($data, ['validate' => 'login']);

    //         if (empty($entity->getErrors())) {
    //             $login = $this->Accounts->find('all')->where(['Accounts.email' => $data['email']])->first();

    //             // $face_image = $r->face_image ? $r->attaches['face_image']['s'] : '';
    //             if ($login) {
    //                 if ($data['password'] == @$login['password']) {
    //                     $this->Session->write([
    //                         'user_data' => [
    //                             'name' => $login['username'],
    //                             'account_type' => $login['account_type'],
    //                             // 'face_image' => $face_image
    //                         ],
    //                     ]);
    //                     return $this->redirect('/');
    //                 } else {
    //                     $this->set('err', 'Sorry, Mật khẩu không đúng.');
    //                 }
    //             } else {
    //                 $this->set('err', 'Sorry, Email không đúng.');
    //             }
    //         }
    //     }
    // }


    public function register($id = 0)
    {
        $list = $this->setLists();
        $this->set('slug', 'login');
        $this->loadModel('Accounts');
        $contact_form = new ContactForm();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $entity = $this->Accounts->newEntity($data);
            // dd($entity->getErrors()); 
            if (empty($entity->getErrors())) {
                $contact_form->_sendmail($data);
                $saved = $this->Accounts->save($entity);

                if ($saved) {
                    // $this->Session->write(['is_login' => true]);
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->set('err', $entity->getErrors());
            // $this->set('err', ['custom' => 'Có lỗi xảy ra , vui lòng đăng kí lại.']);
        }
    }

    // public function logout()
    // {
    //     $this->Session->delete('user_data');
    //     return $this->redirect('/');
    // }


    public function setLists()
    {
        $list = [];

        $opts = [
            'limit' => 5,
            'paginate' => true
        ];
        $opt_trending = [
            'limit' => 5,
            'append_cond' => ['Infos.popular' => 1]
        ];
        $opt_popular = [
            'limit' => 5,
            'append_cond' => ['Infos.popular' => 2]
        ];


        $list['all_news'] = $this->Cms->findAll(NEWS, $opts);
        $list['opt_trending'] = $this->Cms->findAll(NEWS, $opt_trending);
        $list['opt_popular'] = $this->Cms->findAll(NEWS, $opt_popular);

        $list['category'] = $this->loadModel('Categories')
            ->find('all')
            ->where([
                'Categories.status' => 'publish',
                'PageConfigs.slug' => 'news'
            ])
            ->contain('PageConfigs')
            ->toArray();

        if (!empty($list)) $this->set(array_keys($list), $list);
        return $list;
    }
}
