<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){           
            session_start();
            $this->view->info = '';           
            header('location: /perfil');

        }

        public function criarConta(){

            if($this->authAutenticado()){
                header('location: /');
            }
            $this->view->info = '';
            $this->view->erro = isset($_GET['erro']) ? [true, $_GET['erro']]  : [false];
            $this->render('registro');
        }

        public function acessar(){
            
            if($this->authAutenticado()){
                header('location: /');
            }
            $this->view->erro = isset($_GET['erro']) ? [true, $_GET['erro']]  : [false];
            $this->view->info = '';         
            $this->render('login');
        }

        public function implementos(){

            $this->authLogin();

            var_dump($_SESSION);

            $this->view->info = [
                'nome' => '',
                'telefone' => ''
            ];

            $usuario = Container::getModel('usuario');
            $usuario->__set('email', $_SESSION['email']);
            
            if(empty($usuario->testarDados())){
                $this->render('implementos');
            }else{
                header('location: /');
            }
        }
        
    }

?>