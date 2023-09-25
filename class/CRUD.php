<?php
class CRUD{
    /**
     * @return array
     */
    public function getLampes(){
        global $oPDO; 
        $oPDOStatement = $oPDO->query("SELECT id, brand, model, price, type FROM lampe ORDER BY id ASC");

        $lampes = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
        return $lampes;
    }

    public function getLampeById($id){
        global $oPDO; 
        $oPDOStatement = $oPDO->prepare("SELECT id, brand, model, price, type FROM lampe WHERE id = :id");
        $oPDOStatement ->bindParam(':id', $id, PDO::PARAM_INT);

        //execution de la requete
        $oPDOStatement->execute();

        //recuperation de resultat
        $lampe=$oPDOStatement->fetch(PDO::FETCH_ASSOC);
        return $lampe;

    }

    public function addLampe($lampe){
        global $oPDO; 
    
        //preparation de la requete
        $oPDOStatement = $oPDO->prepare('INSERT INTO lampe SET brand=:brand, type=:type, model=:model, price=:price');
        $oPDOStatement ->bindParam(':brand', $lampe['brand'], PDO::PARAM_STR);
        $oPDOStatement ->bindParam(':type', $lampe['type'], PDO::PARAM_STR);
        $oPDOStatement ->bindParam(':model', $lampe['model'], PDO::PARAM_STR);
        $oPDOStatement ->bindParam(':price', $lampe['price'], PDO::PARAM_STR);
    
    
        //execution de la requete
        $oPDOStatement->execute();
    
        //tester le nombre de lignes affectees
        if ($oPDOStatement->rowCount() <= 0) {
            return false;
        }
        return $oPDO->lastInsertId();
    }

    public function updateLampeById($id, $lampe){
        global $oPDO; 
    
        $oPDOStatement = $oPDO->prepare('UPDATE lampe SET brand=:brand, type=:type, model=:model, price=:price WHERE id=:id');
    
        $oPDOStatement->bindParam(':id', $id, PDO::PARAM_INT); 
        $oPDOStatement->bindParam(':brand', $lampe['brand'], PDO::PARAM_STR);
        $oPDOStatement->bindParam(':type', $lampe['type'], PDO::PARAM_STR);
        $oPDOStatement->bindParam(':model', $lampe['model'], PDO::PARAM_STR);
        $oPDOStatement->bindParam(':price', $lampe['price'], PDO::PARAM_STR);
    
        // Exécution de la requête
        $oPDOStatement->execute();
    
        // Tester le nombre de lignes affectées
        if ($oPDOStatement->rowCount() <= 0) {
            return false;
        }
        return true; 
    }

    public function deleteLampeById($id){
        global $oPDO; 
        $lampe=$this->getLampeById($id);

        if($lampe){
            $oPDOStatement = $oPDO->prepare("DELETE FROM lampe WHERE id=:id");
            $oPDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
            $oPDOStatement->execute();

            return "La lampe a etait retiré!!";
        }
        else{
            return "lampe non trouvé";
        }
    }
}
?>