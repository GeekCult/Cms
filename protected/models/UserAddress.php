<?php

/**
 * This is the model class for table "user_address".
 *
 * The followings are the available columns in table 'user_address':
 * @property integer $id
 * @property integer $user_id
 * @property string $zip
 * @property string $address
 * @property string $number
 * @property string $complement
 * @property string $city
 * @property integer $state_id
 * @property integer $address_types_id
 */
class UserAddress extends CActiveRecord{
    /**
     * Returns the static model of the specified AR class.
     * @return UserAddress the static model class
     */
    public static function model($className=__CLASS__){
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName(){
            return 'user_address';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    //array('user_id, zip, address, number, city', 'required'),
                    array('zip, address, number, city, state_id', 'required', 'on'=>'editar_1','message'=>'É necessário preencher o campo {attribute} em Endereço Principal'),
                    array('zip, address, number, city, state_id', 'required', 'on'=>'editar_2','message'=>'É necessário preencher o campo {attribute} em Endereço Secundário'),
                    array('user_id', 'numerical', 'integerOnly'=>true),
                    array('zip', 'length', 'max'=>10),
                    array('address', 'length', 'max'=>255),
                    array('number', 'length', 'max'=>5),
                    array('complement, city', 'length', 'max'=>45),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('id, user_id, zip, address, number, complement, city, bairro, state_id, address_types_id', 'safe', 'on'=>'search'),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations(){
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
                    'user' => array(self::BELONGS_TO, 'User', 'user_id'),
                    'state' => array(self::BELONGS_TO, 'State', 'state_id'),
                    'addressTypes' => array(self::BELONGS_TO, 'AddressType', 'address_types_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
            return array(
                    'id' => 'ID',
                    'user_id' => 'User',
                    'zip' => 'CEP',
                    'address' => 'Endereço',
                    'number' => 'Numero',
                    'complement' => 'Complemento',
                    'city' => 'Cidade',
                    'state_id' => 'Estado',
                    'bairro' => 'Bairro',
                    'address_types_id' => 'Address Types',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search(){
            // Warning: Please modify the following code to remove attributes that
            // should not be searched.

            $criteria=new CDbCriteria;

            $criteria->compare('id',$this->id);
            $criteria->compare('user_id',$this->user_id);
            $criteria->compare('zip',$this->zip,true);
            $criteria->compare('address',$this->address,true);
            $criteria->compare('number',$this->number,true);
            $criteria->compare('complement',$this->complement,true);
            $criteria->compare('city',$this->city,true);
            $criteria->compare('state_id',$this->state_id);
            $criteria->compare('bairro',$this->bairro);
            $criteria->compare('address_types_id',$this->address_types_id);

            return new CActiveDataProvider(get_class($this), array(
                    'criteria'=>$criteria,
            ));
    }
}