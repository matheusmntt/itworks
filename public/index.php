<?php

    require_once('../app/config/global.config.php');
    require_once('../vendor/autoload.php');
    require_once('../app/helpers/redirect.php');

    (new Itworks\core\RouterCore());

    // Frameworks, pesquisar, nome e documentação 
    // PSR1 e PSR4
    // No composer apresentar a modificação q torna o php 8 como requisito obrigatorio
    // No RouterCore apresentar todas as linhas comentadas do que ela faz 