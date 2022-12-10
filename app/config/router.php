<?php

    #http://localhost:8081/
    #http://localhost:8081/home
    
    $this->get('/', 'ContaController@index');
    $this->get('/novo', 'ContaController@novo');
    $this->post('/conta-salvar', 'ContaController@salvar');

    