<?php

namespace App\Form;

use Cake\Form\Schema;
use Cake\Validation\Validator;

class ContactForm extends AppForm
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('customer_type', 'string')
            ->addField('name', 'string')
            ->addField('furigana', 'string')
            ->addField('company_name', 'string')
            ->addField('department', 'string')
            ->addField('contact_type', 'string')
            ->addField('age', 'string')
            ->addField('tel', 'string')
            ->addField('post_code', 'string')
            ->addField('prefectures', 'string')
            ->addField('city', 'string')
            ->addField('building', 'string')
            ->addField('content', 'string')

            ->addField('email', 'string')
            ->addField('check_email', 'string')

            ->addField('chk_privacy', 'integer');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator->setProvider('App', 'App\Validator\AppValidation');

        $validator
            ->notBlank('customer_type', '※ご選択ください')

            ->maxLength('company_name', 100, '※100字以内でご入力ください')
            ->add(
                'company_name',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if ($context['data']['customer_type'] == 2 && $value == '') {
                                return '※法人名をご入力ください';
                            }
                            return true;
                        },
                    ],
                ],
            )

            ->maxLength('department', 50, '※50字以内でご入力ください')
            ->add(
                'department',
                [
                    'custom' => [
                        'rule' => function ($value, $context) {
                            if ($context['data']['customer_type'] == 2 && $value == '') {
                                return '※部署・役職をご入力ください';
                            }
                            return true;
                        },
                    ],
                ],
            )

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
            ->allowEmptyString('post_code', '※郵便番号をご入力ください')
            ->add('post_code', 'valid', ['rule' => [$this, 'checkPostcode'], 'message' => '郵便番号は半角数字でご入力ください'])

            ->allowEmptyString('prefectures')
            ->allowEmptyString('city')
            ->allowEmptyString('building')
            ->allowEmptyString('content')
            ->maxLength('content', 1000, '※1000字以内でご入力ください')

            ->allowEmptyString('tel', '※電話番号は半角数字でご入力ください')
            ->add('tel', 'checkTel', ['rule' => ['checkTel'], 'provider' => 'App', 'message' => '※正しい電話番号を半角数字でご入力ください'])

            ->notBlank('chk_privacy', '※同意してください')
            ->add('chk_privacy', 'custom', ['rule' => [$this, 'checkIsPrivacy'], 'message' => '※同意してください']);

        return $validator;
    }
}
