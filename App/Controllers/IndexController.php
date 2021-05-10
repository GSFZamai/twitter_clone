<?php

    namespace App\Controllers;

    use MF\Controller\Action;


    class IndexController extends Action{

        public function index() {
            //$this->view->dados = array('Caldo Verde', 'Caldo Detox', 'Caldo Laranja');

            $this->render('index', 'layout');
        }

        public function inscreverse() {
            //$this->view->dados = array('Batata', 'Cenoura', 'Cebola');
        
            $this->render('inscreverse', 'layout');
        }

    }

?>