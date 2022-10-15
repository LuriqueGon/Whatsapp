<?php

namespace App; 
use MF\Init\Bootstrap; 

    class Route extends Bootstrap{

        protected function initRoutes(){

            // INDEX

            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );  

            $routes['criarConta'] = array(
                'route' => '/criarConta',
                'controller' => 'IndexController',
                'action' => 'criarConta'
            );  

            $routes['acessar'] = array(
                'route' => '/acessar',
                'controller' => 'IndexController',
                'action' => 'acessar'
            );     
            
            $routes['implementos'] = array(
                'route' => '/implementos',
                'controller' => 'IndexController',
                'action' => 'implementos'
            ); 

            // AUTH

            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'AuthController',
                'action' => 'registrar'
            );  
            
            $routes['autenticar'] = array(
                'route' => '/autenticar',
                'controller' => 'AuthController',
                'action' => 'autenticar'
            );               
            
            $routes['completarInfo'] = array(
                'route' => '/completarInfo',
                'controller' => 'AuthController',
                'action' => 'completarInfo'
            );  

            // APP
            
            $routes['perfil'] = array(
                'route' => '/perfil',
                'controller' => 'AppController',
                'action' => 'perfil'
            );  
            
            $routes['sair'] = array(
                'route' => '/sair',
                'controller' => 'AppController',
                'action' => 'sair'
            ); 

            $routes['solicitacaoRecieve'] = array(
                'route' => '/solicitacaoRecieve',
                'controller' => 'AppController',
                'action' => 'solicitacaoRecieve'
            );  

            $routes['solicitacaoSend'] = array(
                'route' => '/solicitacaoSend',
                'controller' => 'AppController',
                'action' => 'solicitacaoSend'
            );  

            

            // CONTATO

            $routes['addContato'] = array(
                'route' => '/addContato',
                'controller' => 'ContatoController',
                'action' => 'addContato'
            );  

            
            
            
            
            
            
            
            

            $this->setRoutes($routes);
        }

        
    }

?>