<?php
require_once 'Framework/Modele.php';

class Utilisateur extends Modele
{
    public function getUtilisateurs(){
        $sql = 'SELECT numeroUtilisateur, nomUtilisateur FROM utilisateurs ORDER BY numeroUtilisateur';
       $utilisateursReq= $this->executerRequete($sql);
        return $utilisateursReq->fetchAll(\PDO::FETCH_ASSOC);
    }
    function estUtilisateurValide($utilisateur){
        $sql = 'SELECT numeroUtilisateur FROM utilisateurs WHERE numeroUtilisateur = ?';
        $requeteUtilisateur=$this->executerRequete($sql, [$utilisateur]);

        $resultat = $requeteUtilisateur->fetch();
        return $resultat[0]>0;
    }
    public function connecter($login, $mdp)
    {
        $sql = "select numeroUtilisateur from utilisateurs where identifiant = ? and motDePasse = ?";
        $utilisateur = $this->executerRequete($sql, array($login, $mdp));
        return ($utilisateur->rowCount() == 1);
    }
    public function getUtilisateur($login, $mdp)
    {
        $sql = "select numeroUtilisateur, identifiant, motDePasse
            from utilisateurs where identifiant = ? and motDePasse = ?";
        $utilisateur = $this->executerRequete($sql, array($login, $mdp));
        if ($utilisateur->rowCount() == 1)
            return $utilisateur->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
    }
}