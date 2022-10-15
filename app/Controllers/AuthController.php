<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action{

        public function registrar(){

            if($this->authAutenticado()){
                header('location: /');
            }else{

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
                        header('location: /criarConta?erro=1');
                    }
                    
                }else{
    
                    $this->view->info = [
                        'email' => $_POST['email']
                    ];
    
                    header('location: /criarConta?erro=0');
                }           
                
            }

        }    
        
        
            
        public function autenticar(){

            $this->authLogin();

            $usuario = Container::getModel('usuario');
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', md5($_POST['senha']));

            $user = $usuario->autenticar();

            if(!empty($user)){
                $_SESSION['autenticado'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['telefone'] = $user['telefone'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['img'] = $user['img'];
    
                header('location: /');
            }else{
                header('location: /acessar?erro=0');
            }

            
        }
        
        

        public function completarInfo(){
            session_start();

            if(empty($_POST['nome']) || empty($_POST['ddi']) || empty($_POST['ddd']) || empty($_POST['telefone']) || empty($_POST['email'])){
                header('location: /');
            }
            
            $numeroTelefone = $_POST['ddi']. '-' . $_POST['ddd']. '-'. $_POST['telefone'];      

            $usuario = Container::getModel('usuario');
            $usuario->__set('nome',$_POST['nome']);
            $usuario->__set('telefone',$numeroTelefone);
            $usuario->__set('email',$_SESSION['email']);

            

            $_SESSION['nome'] = $usuario->__get('nome');
            $_SESSION['telefone'] = $usuario->__get('telefone');
            $_SESSION['email'] = $usuario->__get('email');
            $_SESSION['img'] = $usuario->__get('img');  
            
            if($usuario->cadastrarDados()){
                header('location: /acessar');
            }
            

            
        }


        

        
    }

?>