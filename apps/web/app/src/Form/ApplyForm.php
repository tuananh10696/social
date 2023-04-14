<?php

namespace App\Form;

use Cake\Form\Schema;
use Cake\Validation\Validator;

class ApplyForm extends AppForm
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('hope_service', 'string')
            ->addField('name', 'string')
            ->addField('furigana', 'string')
            ->addField('gender', 'string')
            ->addField('age', 'string')
            ->addField('tel', 'string')
            ->addField('esidence_name', 'string')
            ->addField('residence_status', 'string')
            ->addField('post_code', 'string')
            ->addField('prefectures', 'string')
            ->addField('city', 'string')
            ->addField('building', 'string')
            ->addField('content', 'string')
            ->addField('email', 'string')
            ->addField('check_email', 'string')
            ->addField('agent_name', 'string')
            ->addField('agent_furigana', 'string')
            ->addField('relation', 'string')
            ->addField('agent_tel', 'string')
            ->addField('sameAddressCheck', 'string')
            ->addField('agent_post_code', 'string')
            ->addField('agent_prefectures', 'string')
            ->addField('agent_city', 'string')
            ->addField('agent_building', 'string')

            ->addField('chk_privacy', 'integer');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator->setProvider('App', 'App\Validator\AppValidation');

        $validator
            ->notBlank('hope_service', '※ご選択ください')

            ->notBlank('name', '※お名前をご入力ください')
            ->notEmptyString('name', '※お名前をご入力ください')
            ->maxLength('name', 50, '※50字以内でご入力ください')

            ->notBlank('furigana', '※フリガナをご入力ください')
            ->notEmptyString('furigana', '※フリガナをご入力ください')
            ->maxLength('furigana', 50, '※50字以内でご入力ください')
            ->add(
                'furigana',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if (!preg_match("/^[ァ-ヶｦ-ﾟー\s]+$/u", $value)) {
                                return '※カタカナでご入力ください';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->notBlank('agent_name', '※お名前をご入力ください')
            ->notEmptyString('agent_name', '※お名前をご入力ください')
            ->maxLength('agent_name', 50, '※50字以内でご入力ください')

            ->notBlank('agent_furigana', '※フリガナをご入力ください')
            ->notEmptyString('agent_furigana', '※フリガナをご入力ください')
            ->maxLength('agent_furigana', 50, '※50字以内でご入力ください')
            ->add(
                'agent_furigana',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if (!preg_match("/^[ァ-ヶｦ-ﾟー\s]+$/u", $value)) {
                                return '※カタカナでご入力ください';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->notEmptyString('gender', '※ご選択ください')

            ->notBlank('age', '※年齢をご入力ください')
            ->notEmptyString('age', '※年齢をご入力ください')
            ->maxLength('age', 3, '※3字以内でご入力ください')
            ->nonNegativeInteger('age', '※年齢は半角数字でご入力ください')

            ->allowEmptyString('post_code', '※郵便番号をご入力ください')
            ->add('post_code', 'valid', ['rule' => [$this, 'checkPostcode'], 'message' => '郵便番号は半角数字でご入力ください'])

            ->allowEmptyString('prefectures')
            ->allowEmptyString('city')
            ->allowEmptyString('building')
            ->allowEmptyString('content')
            ->maxLength('content', 500, '※500字以内でご入力ください')

            ->notEmptyString('contact_type', '※ご選択ください')
            ->notBlank('email', '※メールアドレスをご入力ください')
            ->notEmptyString('email', '※メールアドレスをご入力ください')
            ->maxLength('email', 100, '100字以内でご入力ください')
            ->email('email', true, '※メールアドレスを全て半角で正しくご入力ください')

            ->notBlank('check_email', '※メールアドレスをご入力ください')
            ->notEmptyString('check_email', '※メールアドレスをご入力ください')
            ->maxLength('check_email', 100, '100字以内でご入力ください')
            ->email('check_email', true, '※メールアドレスを全て半角で正しくご入力ください')
            ->add(
                'check_email',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if ($context['data']['email'] != $value) {
                                return 'メールアドレスが一致していません';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->allowEmptyString('agent_post_code', '※郵便番号をご入力ください')
            ->add('agent_post_code', 'valid', ['rule' => [$this, 'checkPostcode'], 'message' => '郵便番号は半角数字でご入力ください'])

            ->allowEmptyString('agent_prefectures')
            ->allowEmptyString('agent_city')
            ->allowEmptyString('agent_building')


            ->notEmptyString('nursing_level', '※ご選択ください')
            ->notEmptyString('nursing_certification', '※ご選択ください')

            ->notBlank('relation', '※入居希望者さまとの続柄をご入力ください')
            ->notEmptyString('relation', '※入居希望者さまとの続柄をご入力ください')
            ->maxLength('relation', 50, '※50字以内でご入力ください')

            ->notBlank('category', '※ご選択ください')

            ->allowEmptyString('residence_status')
            ->allowEmptyString('esidence_name')

            ->allowEmptyString('tel', '※電話番号は半角数字でご入力ください')
            ->add('tel', 'checkTel', ['rule' => ['checkTel'], 'provider' => 'App', 'message' => '※正しい電話番号を半角数字でご入力ください'])

            ->allowEmptyString('agent_tel', '※電話番号は半角数字でご入力ください')
            ->add('agent_tel', 'checkTel', ['rule' => ['checkTel'], 'provider' => 'App', 'message' => '※正しい電話番号を半角数字でご入力ください'])

            ->notBlank('chk_privacy', '※同意してください')
            ->add('chk_privacy', 'custom', ['rule' => [$this, 'checkIsPrivacy'], 'message' => '※同意してください']);

        return $validator;
    }
}
