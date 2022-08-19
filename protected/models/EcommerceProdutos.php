<?php

/**
 * This is the model class for table "ecommerce_produtos".
 *
 * The followings are the available columns in table 'ecommerce_produtos':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $state
 * @property string $marca
 * @property integer $category_id
 * @property string $description
 * @property double $price
 * @property integer $units_min
 * @property integer $units_max
 * @property integer $units_current
 * @property double $weight
 * @property datetime $date_start
 * @property datetime $date_end
 * @property datetime $last_update
 * @property datetime $data
 * @property integer $display_front
 * @property integer $display_promo
 * @property integer $display_company
 * @property integer $show_transport
 */
class EcommerceProdutos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Pool the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ecommerce_produtos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user', 'required','on'=>'criar','message'=>'É necessário preencher o campo {attribute}'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => array(self::BELONGS_TO, 'Conteudo_Categorias', 'category_id'),
			'user' => array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'User',
			'nome' => 'Nome',
			'estado_produto' => 'Estado do Produto',//novo ou usado
			'status' => 'Status do Produto',
                        'marca' => 'Marca',
			'id_categoria' => 'Categoria',
			'descricao' => 'Descrição',
			'preco' => 'Valor',
			'unidades_min' => 'Quantidade mínimo',
                        'unidades_max' => 'Quantidade máximo',
                        'unidades_person' => 'Quantidade máximo por pessoa',
			'peso' => 'Peso',
                        'keyowords' => 'Palavras-chave',
			'date_start' => 'Date Início',
			'date_end' => 'Date Término',
			'show_transport' => 'Transporte',
			'vitrine' => 'Este pool será apresentado na vitrine',
                        'retirar_local' => 'Retirar no local',
			'promocao' => 'Este pool é promocional',
			'display_company' => 'Este pool é para empresas',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('id_user',$this->id_user);

		$criteria->compare('nome',$this->nome,true);

		//$criteria->compare('estado_produto',$this->estado_produto);

                $criteria->compare('marca',$this->marca);

		$criteria->compare('id_categoria',$this->id_categoria);

		$criteria->compare('descricao',$this->descricao,true);

		$criteria->compare('preco',$this->preco);

                $criteria->compare('precoe_real',$this->preco_real);

                $criteria->compare('entrega',$this->entrega);

                //$criteria->compare('unidades_person',$this->unidades_person);

		//$criteria->compare('unidades_min',$this->unidades_min);

                //$criteria->compare('unidades_max',$this->unidades_max);

		//$criteria->compare('peso',$this->peso);
                
                $criteria->compare('retirar_local',$this->retirar_local);

                $criteria->compare('keywords',$this->keywords);

		$criteria->compare('date_start',$this->date_start,true);

		$criteria->compare('date_end',$this->date_end,true);

		$criteria->compare('show_transport',$this->show_transport);

		$criteria->compare('vitrine',$this->vitrine);

		$criteria->compare('promocao',$this->promocao);

		$criteria->compare('display_company',$this->display_company);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}