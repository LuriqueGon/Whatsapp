<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index(){

            $this->view->info = '';           
            $this->view->erro = isset($_GET['erro']) ? [true, $_GET['erro']]  : [false];
            $this->render('registro');

        }

        public function implementos(){
            $this->authLogin();

            $this->view->info = [
                'nome' => '',
                'telefone' => ''
            ];

            $this->render('implementos');
        }



        public function registrar(){
            if($_POST['senha'] == $_POST['resenha']){

                session_start();

                $usuario = Container::getModel('usuario');
                $usuario->__set('email',$_POST['email']);
                $usuario->__set('senha',md5($_POST['senha']));

                if($usuario->criarConta()){

                    $_SESSION['autenticado'] = true;
                    $_SESSION['email'] = $usuario->__get('email');
                    header('location: /implementos');

                }else{
                    session_destroy();
                    header('location: /?erro=1');
                }
                
            }else{

                $this->view->info = [
                    'email' => $_POST['email']
                ];

                header('location: /?erro=0');
            }           
            

        }        

        public function completarInfo(){

            $this->authLogin();           

            $usuario = Container::getModel('usuario');
            $usuario->__set('nome',$_POST['nome']);
            $usuario->__set('telefone',$_POST['telefone']);
            $usuario->__set('email',$_SESSION['email']);
            if($usuario->completarInfo()){
                header('location: /perfil');
            }
            

            
        }


        

        
    }

?>