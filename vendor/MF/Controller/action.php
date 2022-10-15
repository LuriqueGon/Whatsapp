<?php

    namespace MF\Controller;

    abstract class Action{

        protected $view;   

        public function __construct(){
            $this->view = new \stdClass();
        }

        protected function render($view, $layout = 'layout'){
            $this->view->page = $view;

            if(file_exists("../app/View/$layout.phtml")){
                require_once "../app/View/$layout.phtml";
            }else{
                $this->content();
            }
        }

        protected function content(){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            require_once "../app/View/$atualClass/".$this->view->page.".phtml";
        }

        protected function authLogin(){
            session_start();

            if($_SESSION['autenticado']){
                return true;
            }else{
                header('location: /criarConta');
            }

        }

        protected function authAutenticado(){
            session_start();

            if(isset($_SESSION['autenticado'])){
                if($_SESSION['autenticado']){
                    return true;
                }else{
                    return false;
                }
            }
            
        }
    }

?>