<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher;

//use App\Model\Entity\Info;

class HomesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Cms');
    }

    public function beforeFilter(EventInterface $event)
    {

        parent::beforeFilter($event);
    }

    public function index()
    {
        // $this->setList();
        // $options = [
        //     'limit' => 3,
        //     'order' => ['Infos.position' => 'ASC'],
        // ];

        // $this->set('infos', $this->Cms->findAll('news', $options));
    }


    public function setList()
    {
        $list = [];

        $list['category'] = $this->loadModel('Categories')
            ->find('all')
            ->where([
                'Categories.status' => 'publish',
                'PageConfigs.slug' => 'news'
            ])
            ->contain('PageConfigs')
            ->order('Categories.position ASC')
            ->toArray();

        if (!empty($list)) $this->set(array_keys($list), $list);
        return $list;
    }
}
