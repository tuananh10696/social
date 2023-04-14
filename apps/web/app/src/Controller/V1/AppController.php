<?php

namespace App\Controller\V1;

use App\Controller\AppController as BaseController;
use Cake\ORM\TableRegistry;

class AppController extends BaseController
{
    public function session_read($key, $empty = '')
    {
        if (!$this->Session->check($key)) {
            return $empty;
        }

        return $this->Session->read($key);
    }

    public function session_write($key, $val)
    {
        $this->Session->write($key, $val);

        return;
    }

    /**
     * 正常時のレスポンス
     */
    protected function rest_success($datas)
    {

        $data = array(
            'error' => array('code' => 0),
            'result' => $datas
        );

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    protected function rest_custom($data)
    {

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * エラーレスポンス
     */
    protected function rest_error($http_status = 200, $code = '', $message = '')
    {


        $state_list = array(
            '200' => 'empty',
            '400' => 'Bad Request', // タイプミス等、リクエストにエラーがあります。
            '401' => 'Unauthorixed', // 認証に失敗しました。（パスワードを適当に入れてみた時などに発生）
            // '402' => '', // 使ってない
            '403' => 'Forbidden', // あなたにはアクセス権がありません。
            '404' => 'Not Found', // 該当アドレスのページはありません、またはそのサーバーが落ちている。
            '500' => 'Internal Server Error', // CGIスクリプトなどでエラーが出た。
            '501' => 'Not Implemented', // リクエストを実行するための必要な機能をサポートしていない。
            '509' => 'Other', // オリジナルコード　例外処理
        );

        $code2messages = array(
            '1000' => 'パラメーターエラー',
            '1001' => 'パラメーターエラー',
            '1002' => 'パラメーターエラー',
            '2000' => '取得データがありませんでした',
            '2001' => '取得データがありませんでした',
            '3000' => '保存できませんでした',
            '3001' => '送信できませんでした',
            '3002' => '処理に失敗しました',
            '4000' => '',
            '9000' => '認証に失敗しました',
            '9001' => '',
        );

        if (!array_key_exists($http_status, $state_list)) {
            $http_status = '509';
        }


        if ($message == "") {
            if (array_key_exists($code, $code2messages)) {
                $message = $code2messages[$code];
            } elseif (array_key_exists($http_status, $state_list)) {
                $message = $state_list[$http_status];
            }
        }
        if ($code == '') {
            $code = $http_status;
        }
        $data['error'] = array(
            'code' => intval($code),
            'message' => $message
        );

        // セットヘッダー
        // $this->header("HTTP/1.1 " . $http_status . ' ' . $state_list[$http_status], $http_status);
        // $this->response->statusCode($http_status);
        // $this->header("Content-Type: application/json;");

        $this->set(compact('data'));
        $this->set('_serialize', 'data');

        return;
    }

    protected function token($len=64) {
        if ($len > 0) {
            $TOKEN_LENGTH = $len;
            $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
            return bin2hex($bytes);
        } else {
            return '';
        }
    }

    protected function getJson($key = null, $method = 'post')
    {
        if ($method == 'post') {
            $datas = $this->request->getData($key);
        } else {
            $datas = $this->request->getQuery($key);
        }

        if (is_array($datas)) {
            foreach ($datas as $key => $val) {
                if (is_null($val) || $val === 'null') {
                    $datas[$key] = '';
                }
            }
        } else {
            if (is_null($datas) || $datas === 'null') {
                $datas = '';
            }
        }

        return $datas;
    }
}
