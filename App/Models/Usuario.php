<?php 

    namespace App\Models;

    use MF\Model\Model;

    class Usuario extends Model{

        private $id;
        private $name;
        private $email;
        private $senha;

        public function __get($atribute) {
            return $this->$atribute;
        }

        public function __set($atribute, $value) {
            $this->$atribute = $value;
        }

        public function salvar() {
            $query = "insert into usuarios(name, email, senha) values(:name, :email, :senha)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':name', $this->__get('name'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();

            return $this;
        }

        public function validaCadastro() {
            $valida = true;

            if (strlen($this->__get('name')) < 3) {
                $valida = false;
            }

            if(strlen($this->__get('email')) < 3) {
                $valida = false;
            }

            if(strlen($this->__get('senha')) < 3) {
                $valida = false;
            }

            return $valida;
        }

        public function getUsuarioByEmail() {
            $query = "select name, email from usuarios where email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function autenticar() {
            $query = "select id, name, email from usuarios where email = :email and senha = :senha";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(":email", $this->__get('email'));
            $stmt->bindValue(":senha", $this->__get('senha'));
            $stmt->execute();

            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            if ($usuario['id'] != '' && $usuario['name'] != '') {
                $this->__set("id", $usuario['id']);
                $this->__set("name", $usuario['name']);
            }

            return $this;
        }




    };

?>