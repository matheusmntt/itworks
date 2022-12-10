<?php

    namespace Itworks\src\controller;

    use Itworks\core\Controller;
    use Itworks\src\model\ContaModel;
    use Itworks\classes\Input;

    class ContaController extends Controller
    {
        private $contaModel;

        public function __construct()
        {
            $this->contaModel = new ContaModel();
        }

        /**
         * Carrega a página principal
         * 
         * @return void
         */
        public function index()
        {
            $listaExtrato = $this->contaModel->getAll();

            parent::load('conta/main', ['listaExtrato' => $listaExtrato]);
        }

        public function novo()
        {
            parent::load('conta/novo');
        }

        public function salvar()
        {
            $registro = $this->getInputPost();
            
            $result = $this->contaModel->insert($registro);

            if ( $result <= 0 )
            {
                echo "<h2> ERRO </h2>";
            }
            else 
            {
                echo "<h2> SUCESSO </h2>";
            }
        }

        public function getInputPost()
            {
                return(object)[
                    'valor' => Input::post('txtValor', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                    'movimentacao' => Input::post('selMovimentacao', FILTER_UNSAFE_RAW)
                ];
            }

        public function extrato()
        {
            echo "<h2>Extrato da Conta</h2>";

            $obj = new \stdClass();
            $obj->valor = 10.99;
            $obj->movimentacao = 'CREDITO';
            $obj->dataRegistro = date('Y-m-d H:i:s');

            $result = $this->contaModel->insert($obj);
            if ( $result <= 0 )
            {
                echo "<h2> ERRO </h2>";
            }
            else 
            {
                echo "<h2> SUCESSO </h2>";
            }
        }
    }