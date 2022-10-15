<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class ContatoController extends Action{

        public function addContato(){
            session_start();
            $telefoneUser = explode('-', $_POST['telefoneUser']);
            
            $contato = Container::getModel('Contato');
            $contato->__set('ddi', $_POST['ddi']);
            $contato->__set('ddd', $_POST['ddd']);
            $contato->__set('telefone', $_POST['telefone']);
            $contato->__set('idContato', $contato->pegarContato());
            $contato->__set('idUser', $contato->pegarId($telefoneUser[0],$telefoneUser[1],$telefoneUser[2]));
            $contato->salvarContato();

           
        }
    }
?>