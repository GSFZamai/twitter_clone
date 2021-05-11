<?php

    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class IndexController extends Action{

        public function index() {
            
            $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
            $this->render('index', 'layout');
        }

        public function inscreverse() {

            $this->view->usuario = array(
                'name' => '',
                'email' => ''
            );

            $this->view->erroCadastro = false;


            $this->render('inscreverse', 'layout');
        }

        public function registrar() {
 
            //sucesso
            $usuario = Container::getModel('Usuario');

            $usuario->__set('name', $_POST['name']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', md5($_POST['senha']));

            if ($usuario->validaCadastro() && count($usuario->getUsuarioByEmail()) == 0) {
                    $usuario->salvar();

                    $this->render('cadastro');
                } else {

                    $this->view->usuario = array(
                        'name' => $_POST['name'],
                        'email' => $_POST['email']
                    );
                    $this->view->erroCadastro = true;
                    $this->render('inscreverse');
            }

        }

    }

?>