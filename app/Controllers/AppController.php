<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action{

        public function perfil(){
            $this->authLogin();
           
            $this->render('sessaoPerfil');

            
        }

        public function solicitacaoRecieve(){
            header('Content-Type: application/json');

            session_start();

            $contato = Container::getModel('Contato');
            $contato->__set('telefoneCompleto', $_SESSION['telefone']);
            $contato->getId();

            // Recuperando Notificações de recibo de Solicitação
            $solicitacoesRecieve = $contato->getAllRecieve();  
            
            if(!empty($solicitacoesRecieve)){
                foreach($solicitacoesRecieve as $item){
                    $solicitacoesRecieveItens[] = $contato->getInfoRecieve($item);
                }
    
                echo json_encode($solicitacoesRecieveItens);
            }else{

                echo json_encode('Erro');
            }

            
        }

        public function solicitacaoSend(){
            header('Content-Type: application/json');

            session_start();

            $contato = Container::getModel('Contato');
            $contato->__set('telefoneCompleto', $_SESSION['telefone']);
            $contato->getId();

            // Recuperando Notificações de envio de Solicitação
            $solicitacoesSend = $contato->getAllSend(); 

            if(!empty($solicitacoesSend)){
                foreach($solicitacoesSend as $key => $item){
                    $solicitacoesSendItens[] = $contato->getInfoSend($item);
                }
                
                echo json_encode($solicitacoesSendItens);
            }else{

                echo json_encode('Erro');
            }
               

            
            
        }
        

        public function sair(){
            session_start();
            session_destroy();
            var_dump($_SESSION);

            header('location: /acessar');
        }
    }
?>