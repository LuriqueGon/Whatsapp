<?php

namespace App; 
use MF\Init\Bootstrap; 

    class Route extends Bootstrap{

        protected function initRoutes(){
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );          
            
            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'IndexController',
                'action' => 'registrar'
            );          
            
            $routes['implementos'] = array(
                'route' => '/implementos',
                'controller' => 'IndexController',
                'action' => 'implementos'
            );          
            
            $routes['completarInfo'] = array(
                'route' => '/completarInfo',
                'controller' => 'IndexController',
                'action' => 'completarInfo'
            );  
            
            $routes['perfil'] = array(
                'route' => '/perfil',
                'controller' => 'AppController',
                'action' => 'perfil'
            );  
            
            
            
            
            
            

            $this->setRoutes($routes);
        }

        
    }

?>