<?php 

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action{

        public function perfil(){
            $this->render('sessaoPerfil');
        }
    }
?>