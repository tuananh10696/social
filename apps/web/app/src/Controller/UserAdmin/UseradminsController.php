<?php

namespace App\Controller\UserAdmin;

use App\Consts\UseradminConsts;
use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\EventInterface;

use App\Model\Entity\User;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UseradminsController extends AppController
{
    private $list = [];

    public function initialize() :void
    {
        parent::initialize();

        $this->loadModel('Useradmins');
        $this->loadModel('UseradminSites');
    }

    public function beforeFilter(EventInterface $event) {

        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout("user");
        $this->viewBuilder()->setClassName('Useradmin');

        $this->setCommon();

        $this->modelName = $this->name;
        $this->set('ModelName', $this->modelName);

    }

    protected function _getQuery() {
        $query = [];

        return $query;
    }

    protected function _getConditions($query) {
        $cond = [];

        return $cond;
    }

    public function index() {
        $this->checkLogin();
        $this->viewBuilder()->setLayout("index");

        $query = $this->_getQuery();
        $this->set(compact('query'));

        $this->setList();

        $cond = $this->_getConditions($query);
        $cond['role >='] = $this->Session->read('user_role');


        $this->_lists($cond, ['order' => ['id' => 'ASC'],
                              'limit' => 10]);
    }

    public function edit($id=0) {
        $this->checkLogin();
        $this->viewBuilder()->setLayout("edit");

        $query = $this->_getQuery();
        $this->set(compact('query'));

        $this->setList();

        $redirect = ['action' => 'index', '?' => $query];
        $callback = function($id) {
            $useradmins = $this->Useradmins
                ->find()
                ->notMatching('Sites', function($q) {
                    return $q->where(['Sites.id >' => 0]);
                })
                ->all();
            if (!$useradmins->isEmpty()) {
                foreach ($useradmins as $useradmin) {
                    $site = $this->UseradminSites->newEntity(['useradmin_id' => $useradmin->id, 'site_config_id' => 1]);
                    $this->UseradminSites->save($site);
                }
            }

            return true;
        };
        $validate = 'default';

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            if ($id) {
                if ($this->request->getData('_password')) {
                    $this->request = $this->request->withData('password', $data['_password']);
                    $validate = 'modifyIsPass';
                } else {
                    $validate = 'modify';
                }
            } else {
                $validate = 'userNew';
                $this->request = $this->request->withData('password', $data['_password']);
            }
        }

        $options['redirect'] = $redirect;
        $options['callback'] = $callback;
        $options['validate'] = $validate;

        parent::_edit($id, $options);

    }

    public function position($id, $pos) {
        $this->checkLogin();

        $options = [];

        $data = $this->{$this->modelName}->find()->where([$this->modelName . '.id' => $id])->first();
        if (empty($data)) {
            $this->redirect('/user_admin/');
            return;
        }

        $options['redirect'] = ['action' => 'index', '?' => [], '#' => 'content-' . $id];

        return parent::_position($id, $pos, $options);
    }

    public function enable($id) {
        $this->checkLogin();

        $options = [];

        $data = $this->{$this->modelName}->find()->where([$this->modelName . '.id' => $id])->first();
        if (empty($data)) {
            $this->redirect('/user_admin/');
            return;
        }

        $options['redirect'] = ['action' => 'index', '?' => [], '#' => 'content-' . $id];

        parent::_enable($id, $options);

    }

    public function delete($id, $type, $columns = null) {
        $this->checkLogin();

        $data = $this->{$this->modelName}->find()->where([$this->modelName . '.id' => $id])->first();
        if (empty($data)) {
            $this->redirect('/user_admin/');
            return;
        }

        $options = ['redirect' => ['action' => 'index', '?' => []]];

        parent::_delete($id, $type, $columns, $options);
    }


    public function setList() {

        $list = array();

        $list['role_list'] = UseradminConsts::$role_list;

        $user_role_list = UseradminConsts::$role_list;
        $user_role = $this->Session->read('user_role');
        foreach ($user_role_list as $_role => $name) {
            if ($_role >= $user_role) {
                $list['user_role_list'][$_role] = $name;
            }
        }

        if (!empty($list)) {
            $this->set(array_keys($list),$list);
        }

        $this->list = $list;
        return $list;
    }


}
