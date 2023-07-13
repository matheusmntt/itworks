<?php

// Declarando o namespace e subnamespace
namespace Itworks\core;

// Criação da classe RouterCore responsável pelas rotas
class RouterCore {

    private $uri;
    private $method;        // Propriedades da classe
    private $getArr = [];

    // Construtor da classe RouterCore
    public function __construct(){
        // Chamada da função initial()
        $this->initial();
        // Chamada do arquivo de configurações 
        require_once('../app/config/router.php');
        //Chamada da função execute()
        $this->execute();

    }  

    
    private function initial(){ // Declarando o método initial()

        $this->method = $_SERVER['REQUEST_METHOD']; // atribuindo à propriedade 'method' o método de requisição enviado, GET ou POST 
        
        $uri_initial = $_SERVER['REQUEST_URI']; // atribuindo o 'URI' da requisição à variável $uri_initial
        
        if (strpos($uri_initial, '?')) { // strpos encontra a posição da primeira ocorrencia de uma string, nesse caso ele irá avaliar o conteúdo contido em $uri_initial, e irá procurar a primeira ocorrência de '?'

            $uri_initial = mb_substr($uri_initial, 0, strpos($uri_initial, '?')); // a função mb_substr() obtém parte da string, nesse caso, ele irá obter do início do valor contido em $uri_initial até à ocorrência de '?' 
        }

        $ex = explode('/', $uri_initial); // explode() irá dividir a string de $uri_initial em outras strings dividas por '/' e retorna um array com os valores, exemplo: https://www.php.net/manual/pt_BR/function.explode.php => $ex = [manual, pt_BR, function.explode.php]; 

        $uri = array_values(array_filter($ex)); // o método array_values(), retorna todos os valores de um array e array_filter() filtrará todos os valores do array $ex.
        
        for ($i = 0; $i < UNSET_URI_COUNT; $i++) {
            unset($uri[$i]);
        }
        
        $this->uri = implode('/', $this->normalizeURI($uri));

        if (DEBUG_URI){
            echo '<pre>';
                print_r($this->uri);
            echo '</pre>';
        }
    }

    private function normalizeURI($arr)
    {
        return array_values(array_filter($arr));
    }

    private function execute()
    {
        switch ($this->method) {
            case 'GET':
                $this->executeGet();
                break;
            case 'POST':
                $this->executePost();
                break;
        }
    }

    private function executeGet()
    {
        foreach ($this->getArr as $get) {
            $r = substr($get['router'], 1);

            if (substr($r, -1) == '/') {
                $r = substr($r, 0, -1);
            }
            if ($r == $this->uri) {
                if (is_callable($get['call'])) {
                    $get['call']();
                    break;
                } else {
                    $this->executeController($get['call']);
                }
            }
        }
    }

    private function executePost()
    {
        foreach ($this->getArr as $get) {
            $r = substr($get['router'], 1);

            if (substr($r, -1) == '/') {
                $r = substr($r, 0, -1);
            }

            if ($r == $this->uri) {
                if (is_callable($get['call'])) {
                    $get['call']();
                    return;
                }

                $this->executeController($get['call']);
            }
        }
    }

    private function executeController($get)
    {
        $ex = explode('@', $get);
        if (!isset($ex[0]) || !isset($ex[1])) {
            (new \Itworks\core\Controller)->showMessage('Dados inválidos', 'Controller ou método não encontrado: ' . $get, null, 404);
            return;
        }

        $cont = 'Itworks\\src\\controller\\' . $ex[0];
        if (!class_exists($cont)) {
            (new \Itworks\core\Controller)->showMessage('Dados inválidos', 'Controller não encontrada: ' . $get, null, 404);
            return;
        }


        if (!method_exists($cont, $ex[1])) {
            (new \Itworks\core\Controller)->showMessage('Dados inválidos', 'Método não encontrado: ' . $get, null, 404);
            return;
        }

        call_user_func_array([
            new $cont,
            $ex[1]
        ], []);
    }

    private function get($router, $call)
    {
        $this->getArr[] = [
            'router' => $router,
            'call' => $call
        ];
    }

    private function post($router, $call)
    {
        $this->getArr[] = [
            'router' => $router,
            'call' => $call
        ];
    }

}
