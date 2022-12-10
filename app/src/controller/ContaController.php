<?php

    namespace Itworks\src\controller;

    use Itworks\core\Controller;
    use Itworks\src\model\ContaModel;

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