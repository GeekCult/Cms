<?php

/**
 * This is the model class for table "user_data".
 *
 * The followings are the available columns in table 'user_data':
 * @property integer $id
 * @property string $field1
 * @property string $field2
 * @property string $email
 * @property string $password
 * @property integer $account_states_id
 * @property integer $type
 * @property string $creation
 * @property integer $account_locked
 * @property string $email_hash
 * @property integer $receive_news
 * @property integer $receive_sms
 * @property integer $birthday
 */
class User extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user_data';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('field1, field2, email, password', 'required', 
                        'message' => 'É necessário preencher o campo {attribute}.', 'on' => 'Criar'),
                array('type, account_locked, receive_news', 'numerical', 'integerOnly'=>true),
                array('field1, field2', 'length', 'max'=>100),
                array('avatar', 'length', 'max'=>255),
                array('email, password, email_hash', 'length', 'max'=>95),
                array('creation', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                'accountStates' => array(self::BELONGS_TO, 'AccountStates', 'account_states_id'),
                'userAddresses' => array(self::HAS_MANY, 'UserAddress', 'user_id'),
                'userAtrributes' => array(self::HAS_MANY, 'UserAtrribute', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => 'ID',
                'field1' => 'Nome',
                'field2' => 'Sobrenome',
                'email' => 'E-mail',
                'birthday' => 'Aniversario',
                'password' => 'Senha',
                'avatar' => 'Avatar',
                'account_states_id' => 'Account States',
                'type' => 'Tipo',
                'creation' => 'Criacao',
                'account_locked' => 'account_locked',
                'email_hash' => 'email_hash',
                'receive_news' => 'receive_news',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria=new CDbCriteria;
        $criteria->compare('id',$this->id);        
        $criteria->compare('avatar',$this->avatar);
        $criteria->compare('field1',$this->field1,true);
        $criteria->compare('field2',$this->field2,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('birthday',$this->birthday,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('account_states_id',$this->account_states_id);
        $criteria->compare('type',$this->type);
        $criteria->compare('creation',$this->creation,true);
        $criteria->compare('account_locked',$this->account_locked);
        $criteria->compare('email_hash',$this->email_hash,true);
        $criteria->compare('receive_news',$this->receive_news);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}


