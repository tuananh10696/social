<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;

class Useradmin extends AppEntity
{

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }

    protected function _getListName()
    {
        return "{$this->_properties['name']}({$this->_properties['username']})";
    }
}
