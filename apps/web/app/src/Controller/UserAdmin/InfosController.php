<?php

namespace App\Controller\UserAdmin;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class InfosController extends BaseInfosController
{


    public function initialize(): void
    {
        parent::initialize();

        $this->modelName = 'Infos';
        $this->set('ModelName', $this->modelName);
        $this->InfoTops = $this->getTableLocator()->get('InfoTops');
    }
}
