<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Usuario extends Model{
        private $id;
        private $nome;
        private $telefone;
        private $email;
        private $senha;

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            return $this->$attr = $value;
        }

        public function criarConta(){
            if($this->validarDados(0)){
                echo 'vazzio';
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

        public function completarInfo(){

            if($this->validarDados(1)){
                $query = "INSERT INTO users_implements (email, nome, telefone) VALUES (?,?,?)";
                $stmt = $this->db->prepare($query);
    
                $stmt->bindValue(1,$this->__get('email'));
                $stmt->bindValue(2,$this->__get('nome'));
                $stmt->bindValue(3,$this->__get('telefone'));
                $stmt->execute();
                
                return true;

            }else{
                return false;
            }

        }

        private function validarDados($all = 0){
            if($all == 1){
                if(strlen($this->__get('nome')) < 3){
                    return false;
                }

                if(strlen($this->__get('telefone')) < 10){
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
        
    }

?>