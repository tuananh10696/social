<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Mailer\Mailer;
use Cake\Datasource\ConnectionManager;
use App\Utils\CustomUtility;
use App\Form\ApplyForm;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class ApplyController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // $this->setHeadTitle('移住・定住に関するお問い合わせ');
        // $this->set('__description__', 'お問い合わせフォームはこちら。まずはお気軽にご相談ください');
    }


    public function index($page = 'index')
    {
        $this->viewBuilder()->setClassName('Contact');
        $this->setList();
        $has_session = $this->Session->read('apply');
        $page = in_array($page, ['index', 'confirm', 'complete'], true) ? $page : 'index';

        if (in_array($page, ['confirm', 'complete'], true) && !$has_session) $this->redirect(['action' => 'index']);

        $contact_form = new ApplyForm();

        $contact_form = $has_session ? $contact_form->setData($this->Session->read('apply')) : $contact_form;
        if ($has_session && in_array($page, ['index', 'complete'], true)) $this->Session->delete('apply');

        $error = [];
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();

            $contact_form->validate($data);
            if (empty($contact_form->getErrors())) {
                $page_view = 'index';
                if ($page == 'index') {

                    $this->Session->write(['apply' => $data]);
                    $page_view = 'confirm';
                } elseif ($page == 'confirm') {
                    // mail send
                    $this->_sendmail($data);
                    $page_view = 'complete';
                }
                $this->redirect(['action' => 'index', $page_view]);
            } else $error = $contact_form->getErrors();
        }

        $this->set('error', $error);
        $this->set('form_data', $contact_form->getData());
        $this->set('contact_form', $contact_form);
        $this->render($page);
    }


    public function setList()
    {
        $list = [];
        $list['hope_service'] = ['特別養護老人ホーム', '短期入所生活介護(ショートステイ)'];
        $list['gender'] = ['男性', '女性', 'その他'];
        $list['residence_status'] = ['自宅', '介護施設', 'その他'];
        $list['nursing_level'] = ['1', '2', '3', '4', '5', 'その他'];
        $list['nursing_certification'] = ['申請済', '申請中', 'その他'];

        $list['body_class'] = 'page-reserve';

        if (!empty($list)) $this->set(array_keys($list), $list);

        $this->list = $list;
        return $list;
    }


    private function _sendmail($form)
    {
        $contact_form = new ApplyForm();

        // 文字化け対応
        $form['content'] = CustomUtility::_preventGarbledCharacters($form['content']);

        $to = ['test+reiwakai@caters.co.jp'];
        $from = ['test+reiwakai@caters.co.jp' => '社会福祉法人 令和会'];

        $test_dev_local_server = (strpos($_SERVER["HTTP_HOST"], 'test') !== false ||
            strpos($_SERVER["HTTP_HOST"], 'caters') !== false ||
            strpos($_SERVER["HTTP_HOST"], 'loca') !== false ||
            strpos($_SERVER["HTTP_HOST"], 'localhost') !== false);

        $is_honban = !Configure::read('debug') && !$test_dev_local_server;

        if ($is_honban) {
            // 本番の場合
            $to = [''];
            $from = ['' => '社会福祉法人 令和会'];
        }

        $info_email = new Mailer();
        $info_email->setCharset('ISO-2022-JP-MS')
            ->setEmailFormat('text')
            ->setFrom($from)
            ->setTo($to)
            ->setViewVars(['form' => $form, 'list' => $this->setList()])
            ->setSubject('【社会福祉法人 令和会】お問い合わせがありました')
            ->viewBuilder()
            ->setTemplate('apply_admin');

        $info_email->send();

        $thank_email = new Mailer();
        $thank_email->setCharset('ISO-2022-JP-MS')
            ->setEmailFormat('text')
            ->setViewVars(['form' => $form, 'list' => $this->setList()])
            ->setFrom($from)
            ->setTo($form['email'])
            ->setSubject('【社会福祉法人 令和会】お問い合わせありがとうございます')
            ->viewBuilder()
            ->setTemplate('apply_user');

        $thank_email->send();
    }
}
