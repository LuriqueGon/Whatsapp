<?php 

    namespace App\Models;
    use MF\Model\Model;

    class Contato extends Model{
        public $ddi;
        public $ddd;
        public $telefone;
        public $telefoneCompleto;
        public $idContato;
        public $idUser;

        
        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
            return $this;
        }

        public function pegarContato(){
            $query = "SELECT id FROM telefones WHERE ddi = ? AND ddd = ? AND telefone = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->__get('ddi'));
            $stmt->bindValue(2,$this->__get('ddd'));
            $stmt->bindValue(3,$this->__get('telefone'));
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['id'];
            
        }

        public function pegarId($ddi, $ddd, $numero){
            $query = "SELECT id FROM telefones WHERE ddi = ? AND ddd = ? AND telefone = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$ddi);
            $stmt->bindValue(2,$ddd);
            $stmt->bindValue(3,$numero);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)['id'];
        }

        public function salvarContato(){

            if(empty($this->testarSolicitacao())){
                $query = "INSERT INTO contatos (idTelefoneContato, idTelefoneUser,TelefoneContato, TelefoneUser) VALUES (?,?,?,?) ";
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(1,$this->idContato);
                $stmt->bindValue(2,$this->idUser);
                $stmt->bindValue(3,$this->ddi. '-'.$this->ddd. '-'.$this->telefone);
                $stmt->bindValue(4,$_SESSION['telefone']);
                $stmt->execute();
                echo 'Deu Certo';
            }else{
                echo 'Deu errado';
            }
            
        }

        public function testarSolicitacao(){
            $query = "SELECT id FROM contatos WHERE (idTelefoneContato = ? AND idTelefoneUser = ?) OR solicitacao = 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->idContato);
            $stmt->bindValue(2,$this->idUser);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getId(){
            $query = "SELECT id FROM telefones WHERE telefoneCompleto = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->telefoneCompleto);
            $stmt->execute();
            $this->idUser = $stmt->fetch(\PDO::FETCH_ASSOC)['id'];
            return $this;
            
        }
    
        public function getAllSend(){
            $query = "SELECT id, idTelefoneContato, telefoneContato, Solicitacao FROM contatos WHERE idTelefoneUser = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->idUser);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC); 
            
        }

        public function getInfoSend($item){
            $query = "SELECT email, nome, img FROM users_implements WHERE telefone = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$item['telefoneContato']);
            $stmt->execute();
            $item = [$stmt->fetch(\PDO::FETCH_ASSOC), $item['id'], $item['telefoneContato']];
            return $item;
        }

        public function getAllRecieve(){
            $query = "SELECT id, idTelefoneUser, telefoneUser, Solicitacao FROM contatos WHERE idTelefoneContato = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$this->idUser);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getInfoRecieve($item){
            $query = "SELECT email, nome, img FROM users_implements WHERE telefone = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(1,$item['telefoneUser']);
            $stmt->execute();
            $item = [$stmt->fetch(\PDO::FETCH_ASSOC), $item['id'], $item['telefoneUser']];
            return $item; 
        }
    }