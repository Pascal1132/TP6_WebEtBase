<?php
require_once 'Framework/Modele.php';

class Chambre extends Modele
{

    function getChambres(){
        $sql = 'SELECT * FROM chambres WHERE efface = 0 ORDER BY numeroChambre ';
        $resultat = $this->executerRequete($sql);
        return $resultat->fetchAll(\PDO::FETCH_ASSOC);
    }
    function estNoChambrePresent($noChambre){
        $sql = 'SELECT numeroChambre FROM chambres WHERE numeroChambre = 
		? AND efface = 0';
        $resultat = $this->executerRequete($sql,[$noChambre])->fetch();

        return $resultat[0]>0;
    }
    function insertionChambre($chambre){
        $fichierImage = "";
        if($chambre['image']['size']!=0){
            $fichierImage = $this->enregistrerImage($chambre['image']);
        }

        $sql = 'INSERT INTO chambres (numeroChambre, nombreLits, typeChambre_fk, image) VALUES(?, ?, ?, ?)';
        $result = $this->executerRequete($sql, [$chambre['numero'], $chambre['lits'], $chambre['type'], $fichierImage]);
    return $result;
    }
    function suppressionChambre($id){

        $sql = 'DELETE FROM `chambres` WHERE numeroChambre = ?';
        return $this->executerRequete($sql, [$id]);

    }
    // Enregistre une image associé à une chambre
    private function enregistrerImage($image) {

        // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
        if (isset($image) AND $image['error'] == 0) {
            // Testons si le fichier n'est pas trop gros
            $dimension = $image['size'];
            if ($dimension <= 1000000) {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($image['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    // On peut valider le fichier et le stocker définitivement
                    $fichierImage = 'Contenu/Images/Chambres/' . basename($image['name']);
                    move_uploaded_file($image['tmp_name'], $fichierImage);
                    return basename($image['name']);
                } else {
                    throw new Exception("L'extension '$extension_upload' n'est pas autorisée pour les images");
                }
            } else {
                throw new Exception("Votre image ($dimension octets) dépasse la dimension autorisée (1000000 octets)");
            }
        } else {
            throw new Exception("Erreur rencontrée lors de la transmission du fichier");
        }
    }
}