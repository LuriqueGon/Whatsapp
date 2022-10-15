<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Usuario extends Model{
        private $id;
        private $nome;
        private $telefone;
        private $email;
        private $senha;
        private $perfil;

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            return $this->$attr = $value;
        }

        public function criarConta(){
            if($this->validarDados(0)){
                if($this->userExists() == []){

                    $query = "INSERT INTO users (email, senha) VALUES (?,?)";
                    $stmt = $this->db->prepare($query);

                    $stmt->bindValue(1,$this->__get('email'));
                    $stmt->bindValue(2,$this->__get('senha'));
                    $stmt->execute();

                    

                    return true;

                }else{
                    
                    return false;
                }
            }
        }

        public function cadastrarDados(){

            if($this->validarDados(1)){
                if($this->testarDados() == []){
                    $query = "INSERT INTO users_implements (email, nome, telefone) VALUES (?,?,?)";
                    $stmt = $this->db->prepare($query);
        
                    $stmt->bindValue(1,$this->__get('email'));
                    $stmt->bindValue(2,$this->__get('nome'));
                    $stmt->bindValue(3,$this->__get('telefone'));
                    $stmt->execute();

                    $query = "INSERT INTO telefones (ddi,ddd,telefone,telefoneCompleto) VALUES (?,?,?,?)";
                    $stmt = $this->db->prepare($query);
        
                    $telefone = explode("-",$this->__get('telefone'));
                    
                    $stmt->bindValue(1,$telefone[0]);
                    $stmt->bindValue(2,$telefone[1]);
                    $stmt->bindValue(3,$telefone[2]);
                    $stmt->bindValue(4,$this->__get('telefone'));
                    $stmt->execute();
                    
                    return true;

                }

            }else{
                return false;
            }

        }

        public function testarDados(){
            $query = "SELECT nome, telefone, img FROM users_implements WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get('email'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);

        }

        private function validarDados($all = 0){
            if($all == 1){
                if(strlen($this->__get('nome')) < 3){
                    return false;
                }

                return true;
                
            }else{            

                if(strlen($this->__get('email')) < 8){
                    return false;
                }       

                return true;         
            }

        }
        
        private function userExists(){
            $query = "SELECT email FROM users WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
            

        }

        public function autenticar(){
            $query = "SELECT u.id, i.nome, u.email, i.telefone, i.img FROM users as u INNER JOIN users_implements as i ON(u.email = i.email) WHERE u.email = ? AND u.senha = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1, $this->__get('email'));
            $stmt->bindValue(2, $this->__get('senha'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        
    }

?>