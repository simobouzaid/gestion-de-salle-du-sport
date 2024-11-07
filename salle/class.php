<?php

class cm {
    private $name;
    private $password;
    private $responsable_id;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function fullselect($id){
       


        $this->responsable_id=$id;
        $clients = $this->pdo->prepare('SELECT id, nom_cl, prenom_cl, prix, date_inscp, date_pm FROM client WHERE  responsable_id = ?;');
        $clients->execute([$this->responsable_id]);
        $results = $clients->fetchAll(PDO::FETCH_ASSOC);
        return $results;

    }

    public function nsp($name, $prenom) {
        $this->name = $name;
        $this->password = $prenom;
        $sqlstate = $this->pdo->prepare('INSERT INTO responsable (name, password) VALUES (?, ?)');
        $sqlstate->execute([$this->name, $this->password]);
    }

    public function suprimmer($i) {
        $id = $i;
        $sqlstate = $this->pdo->prepare('DELETE FROM client WHERE id = ?');
        $sqlstate->execute([$id]);
    }

    public function toute($id) {

        $responsable_id=$id;

        $sqlstate = $this->pdo->prepare('DELETE FROM client where responsable_id=?');
        $sqlstate->execute([$responsable_id]);
    }

    public function update($dateInscription, $datePayment, $id) {
        $date_inscp = new DateTime($dateInscription);
        $date_pm = new DateTime($datePayment);
    
        $date_pm1 = $date_pm->modify('+30 days')->format('Y-m-d');
        $date_inscp1 = $date_inscp->format('Y-m-d');
    
        $sqlstate = $this->pdo->prepare('UPDATE client SET date_inscp = ?, date_pm = ? WHERE id = ?');
        $sqlstate->execute([$date_inscp1, $date_pm1, $id]);
    }
    
    public function statique($star,$end,$id){
        
        $sql=$this->pdo->prepare('SELECT COUNT(*) AS total from client where dates between ? And ? and responsable_id=?');
        $sql->execute([$star,$end,$id]);
        $total=$sql->fetch(PDO::FETCH_ASSOC);
        return $total['total'];


    }
    public function fullstatique($id){
        
        $sql=$this->pdo->prepare('SELECT COUNT(*) AS total from client where responsable_id=?');
        $sql->execute([$id]);
        $total=$sql->fetch(PDO::FETCH_ASSOC);
        return $total['total'];


    }


}
class e extends cm{

}
