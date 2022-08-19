<?php

/*
 * This Class is used to controll all functions related the feature Itau
 *
 * @author CarlosGarcia
 *
 * Date: 01/09/2016
 *
 */

class ItauManager{
    
    /**
     * Gerar Arquivo de Remessa para Registro de Título
     * 
     * @params array
     *
    */
    public function geraRemessaTitulo($data = array()){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        Yii::import('application.extensions.utils.erp.BancosUtils');

        Yii::setPathOfAlias('Cnab',Yii::getPathOfAlias('application.extensions.vendors.CnabPHP.src.Cnab'));

        try{           
            // get bank informations
            $bankInfo = BancosUtils::getBankInfo('itau');

            // Configurações para o Banco Itaú
            $codigo_banco = Cnab\Banco::ITAU;
            $config = array();
            $config['banco'] = $codigo_banco; //código do banco
            $config['agencia'] = $bankInfo['agencia'];
            $config['conta'] = $bankInfo['conta'];
            $config['conta_dac'] = $bankInfo['digito_conta'];

            // Informações do Emitente do Boleto
            $config['nome_fantasia'] = 'PurplePier'; // seu nome de empresa
            $config['razao_social'] = 'Carlos Lopes Garcia Mei';  // sua razão social
            $config['cnpj'] = '19286782000103'; // seu cnpj completo
            $config['logradouro'] = 'R JOSE AUGUSTO ROXO MOREIRA';
            $config['numero'] = '129';
            $config['bairro'] = 'RESIDENCIAL SAO LUIZ';
            $config['cidade'] = 'Valinhos';
            $config['uf'] = 'SP';
            $config['cep'] = '13270450';

            // Data de Geração e Gravação do Boleto
            $config['data_geracao']  = new DateTime();
            $config['data_gravacao'] = new DateTime();

            $arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);
            $arquivo->configure($config);

            foreach ($data as $titulo) {
                $recordset = array('id_da_cobranca' => $titulo['id']);
                // Configurações Registro de Entrada de Titulo
                $boleto['codigo_ocorrencia'] =  1; // 1 = Entrada de título, futuramente poderemos ter uma constante;
                $boleto['nosso_numero'] = $titulo['id'];
                $boleto['numero_documento'] = $titulo['id'];
                $boleto['carteira'] = '109';
                $boleto['especie'] = Cnab\Especie::ITAU_DUPLICATA_DE_SERVICO; // Você pode consultar as especies Cnab\Especie
                $boleto['instrucao1'] = 2; // 1 = Protestar com (Prazo) dias, 2 = Devolver após (Prazo) dias
                $boleto['instrucao2'] = 0; // preenchido com zeros
                $boleto['valor'] = $titulo['valor'];  // Valor do boleto

                // Informações do Sacado
                $boleto['sacado_nome'] = 'Vagner Alves'; // O Sacado é o cliente, preste atenção nos campos abaixo
                $boleto['sacado_tipo'] = '1'; //campo fixo, escreva 'cpf' (sim as letras cpf) se for pessoa fisica, cnpj se for pessoa juridica
                $boleto['sacado_cpf']  = '26836695858';
                $boleto['sacado_logradouro'] = 'Rua Engenheiro Mayer, 380';
                $boleto['sacado_bairro'] = 'Bairro Panorama';
                $boleto['sacado_cep'] = '13277460'; // sem hífem
                $boleto['sacado_cidade'] = 'Valinhos';
                $boleto['sacado_uf'] = 'SP';

                $boleto['data_vencimento'] = new DateTime($titulo['vencimento']);
                $boleto['data_cadastro'] = new DateTime();
                $boleto['juros_de_um_dia'] = 0.10; // Valor do juros de 1 dia'
                $boleto['data_desconto'] = new DateTime($titulo['vencimento']);
                $boleto['valor_desconto'] = 10.0; // Valor do desconto
                $boleto['prazo'] = $titulo['prazo']; // prazo de dias para o cliente pagar após o vencimento
                $boleto['taxa_de_permanencia'] = '0'; //00 = Acata Comissão por Dia (recomendável), 51 Acata Condições de Cadastramento no ITAÚ
                $boleto['mensagem'] = 'Descrição do boleto';
                $boleto['data_multa'] = new DateTime($titulo['vencimento']); // titulo da multa
                $boleto['valor_multa'] = $titulo['multa']; // valor da multa

                // você pode adicionar vários boletos em uma remessa
                $arquivo->insertDetalhe($boleto);
            }

            // para salvar
            $arquivo->save(Yii::app()->basePath . '/runtime/remessa-titulo.txt');

            return $recordset;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ItauManager - geraRemessaTitulo() ". $e->getMessage();
        }
    }

    /**
     * Gerar Arquivo de Remessa para Registro de Título
     *
     * @params array
     *
     */
    public function geraRemessaProtesto($data = array()){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.lib.MathUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        Yii::import('application.extensions.utils.erp.BancosUtils');

        Yii::setPathOfAlias('Cnab',Yii::getPathOfAlias('application.extensions.vendors.CnabPHP.src.Cnab'));

        try{
            $recordset = array('id_da_cobranca' => $data['id']);

            // get bank informations
            $bankInfo = BancosUtils::getBankInfo('itau');

            // Configurações para o Banco Itaú
            $codigo_banco = Cnab\Banco::ITAU;
            $config = array();
            $config['banco'] = $codigo_banco; //código do banco
            $config['agencia'] = $bankInfo['agencia'];
            $config['conta'] = $bankInfo['conta'];
            $config['conta_dac'] = $bankInfo['digito_conta'];

            // Informações do Emitente do Boleto
            $config['nome_fantasia'] = 'PurplePier'; // seu nome de empresa
            $config['razao_social'] = 'Carlos Lopes Garcia Mei';  // sua razão social
            $config['cnpj'] = '19286782000103'; // seu cnpj completo
            $config['logradouro'] = 'R JOSE AUGUSTO ROXO MOREIRA';
            $config['numero'] = '129';
            $config['bairro'] = 'RESIDENCIAL SAO LUIZ';
            $config['cidade'] = 'Valinhos';
            $config['uf'] = 'SP';
            $config['cep'] = '13270450';

            // Data de Geração e Gravação do Boleto
            $config['data_geracao']  = new DateTime();
            $config['data_gravacao'] = new DateTime();

            $arquivo = new Cnab\Remessa\Cnab400\Arquivo($codigo_banco);
            $arquivo->configure($config);

            // Configurações Registro de Protesto de Títulos
            $boleto['codigo_ocorrencia'] =  9; // 9 = Protesto de título, futuramente poderemos ter uma constante;
            $boleto['nosso_numero'] = $data['id'];
            $boleto['numero_documento'] = $data['id'];
            $boleto['carteira'] = '109';
            $boleto['especie'] = 0;
            $boleto['instrucao1'] = 0; // 1 = Protestar com (Prazo) dias, 2 = Devolver após (Prazo) dias
            $boleto['instrucao2'] = 0; // preenchido com zeros
            $boleto['valor'] = $data['valor'];  // Valor do boleto

            // Informações do Sacado
            $boleto['sacado_nome'] = 'Vagner Alves'; // O Sacado é o cliente, preste atenção nos campos abaixo
            $boleto['sacado_tipo'] = '1'; //campo fixo, escreva 'cpf' (sim as letras cpf) se for pessoa fisica, cnpj se for pessoa juridica
            $boleto['sacado_cpf']  = '26836695858';
            $boleto['sacado_logradouro'] = 'Rua Engenheiro Mayer, 380';
            $boleto['sacado_bairro'] = 'Bairro Panorama';
            $boleto['sacado_cep'] = '13277460'; // sem hífem
            $boleto['sacado_cidade'] = 'Valinhos';
            $boleto['sacado_uf'] = 'SP';

            $boleto['data_vencimento'] = new DateTime();
            $boleto['data_cadastro'] = new DateTime();
            $boleto['juros_de_um_dia'] = 0; // Valor do juros de 1 dia'
            $boleto['data_desconto'] = 0;
            $boleto['valor_desconto'] = 0; // Valor do desconto
            $boleto['prazo'] = $data['prazo']; // prazo de dias para o cliente pagar após o vencimento
            $boleto['taxa_de_permanencia'] = '0'; //00 = Acata Comissão por Dia (recomendável), 51 Acata Condições de Cadastramento no ITAÚ
            $boleto['mensagem'] = '';
            $boleto['data_multa'] = '0'; // data da multa
            $boleto['valor_multa'] = 0; // valor da multa

            // você pode adicionar vários boletos em uma remessa
            $arquivo->insertDetalhe($boleto);

            // para salvar
            $arquivo->save(Yii::app()->basePath . '/runtime/remessa-protesto.txt');

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ItauManager - geraRemessaTitulo() ". $e->getMessage();
        }
    }

    /**
     * Lê Arquivo de Retorno da Remessa para Baixa de Títulos
     *
     * @params array
     *
     */
    public function lerRetornoRemessa() {
        Yii::setPathOfAlias('Cnab',Yii::getPathOfAlias('application.extensions.vendors.CnabPHP.src.Cnab'));

        try{
            $cnabFactory = new Cnab\Factory();
            $arquivo = $cnabFactory->createRetorno(Yii::app()->basePath . '/runtime/RET1010.RET');
            $detalhes = $arquivo->listDetalhes();
            foreach($detalhes as $detalhe) {
                if($detalhe->getValorRecebido() > 0) {
                    $nossoNumero   = $detalhe->getNossoNumero();
                    $valorRecebido = $detalhe->getValorRecebido();
                    $dataPagamento = $detalhe->getDataOcorrencia();
                    $carteira      = $detalhe->getCarteira();
                    // você já tem as informações, pode dar baixa no boleto aqui
                }
            }
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ItauManager - lerRetornoRemessa() ". $e->getMessage();
        }

    }
}


?>