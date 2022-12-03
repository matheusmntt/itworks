<?php

    #http://localhost:8081/
    #http://localhost:8081/home
    
    $this->get('/', 'HomeController@home');
    $this->get('/home', 'HomeController@home');
    $this->get('/extrato', 'ContaController@extrato');