<?php

namespace Itworks\core;

class Controller 
{
    /**
     * Carregar a View 
     * 
     * @param string $view Tela = tela a ser carregada
     * @param array $params Parâmetros para serem impressos na tela 
     * 
     * @return string
     */
    protected function load(string $view, $params = [])
    {
        //Carrega arquivos
        $twig = new \Twig\Environment( new \Twig\Loader\FilesystemLoader('../app/src/view'));

        //Define URL
        $twig->addGlobal('BASE', BASE);

        //Imprime a renderização
        echo $twig->render($view . '.twig.php', $params);
    }

    public function showMessage(string $titulo, string $descricao, string $link = null, int $httpode = 200)
    {
        http_response_code($httpCode);

        $this->load('partials/message', ['titulo' => $titulo, 'descricao' => $descricao, 'link' => $link]);
    }
}