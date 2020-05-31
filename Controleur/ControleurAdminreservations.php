<?php
require_once 'Framework/Vue.php';
require_once 'Modele/Reservation.php';
require_once 'Modele/Chambre.php';
require_once 'Modele/Utilisateur.php';
require_once 'Modele/Outils.php';
require_once 'Framework/Controleur.php';
require_once 'Controleur/ControleurAdmin.php';

class ControleurAdminreservations extends ControleurAdmin
{

    private $reservation;
    private $chambre;
    private $utilisateur;
    private $outils;

    public function __construct()
    {
        $this->chambre = new Chambre();
        $this->reservation = new Reservation();
        $this->utilisateur = new Utilisateur();
        $this->outils = new Outils();
    }

    public function modifier()
    {
        $id = $this->requete->getParametreId('id');

        $chambresTab = $this->chambre->getChambres();
        $resultat = $this->reservation->getInformationsReservation($id);
        $utilisateursTab = $this->utilisateur->getUtilisateurs();
        $msgCode = "";
        if($this->requete->existeParametre('msg')){
            $msgCode = $this->requete->getParametre('msg');
        }

        $msg=$this->outils->getMessageInfo($msgCode);

        $this->genererVue(array("msgCode" => $msgCode, "msg" => $msg, "chambresTab" => $chambresTab, "utilisateursTab" => $utilisateursTab, "resultat" => $resultat, "id" => $id));
    }

    public function supprimer()
    {
        $id = $this->requete->getParametreId('id');
        $this->reservation->suppressionReservation($id);
        $this->executerAction('index');
    }

    public function confirmerSuppression($id)
    {
        $resultat=$this->reservation->getInformationsReservation($id);
        $vue = new Vue("ConfirmerSuppression");

        $vue->generer(array("id" => $id,"resultat"=>$resultat));
    }


    public function confirmer(){
        $id=$this->requete->getParametreId('id');
        $resultat=$this->reservation->getInformationsReservation($id);
        $this->genererVue(['resultat'=>$resultat]);
    }
    public function miseAJour(){
        if ($this->requete->getSession()->getAttribut("env") == 'prod') {
            $this->requete->getSession()->setAttribut("message", "Modifier une réservation n'est pas permis en démonstration");
        } else {
            $reservation['id'] = $this->requete->getParametre('id');
            $reservation['dateDepart'] = $this->requete->getParametre('dateDepart');
            $reservation['dateArrivee'] = $this->requete->getParametre('dateArrivee');
            $reservation['utilisateur'] = $this->requete->getParametre('utilisateur');
            $reservation['chambre'] = $this->requete->getParametre('chambre');
            $this->reservation->miseAJourReservation($reservation);
        }
        $this->executerAction('index');
    }


    public function index()
    {
        $msgCode = "";
        if($this->requete->existeParametre('msg')){
            $msgCode = $this->requete->getParametre('msg');

        }

        $msg = $this->outils->getMessageInfo($msgCode);
        $reservations = $this->reservation->getReservations();
        $utilisateursTab = $this->utilisateur->getUtilisateurs();
        $chambresTab = $this->chambre->getChambres();
        $this->genererVue(['utilisateursTab'=>$utilisateursTab, 'msg'=>$msg, 'msgCode'=>$msgCode, 'reservations'=>$reservations, 'chambresTab'=>$chambresTab]);
    }
    public function ajouter(){

        $nouvelleReservation['dateDepart'] = $this->requete->getParametre('dateDepart');
        $nouvelleReservation['dateArrivee'] = $this->requete->getParametre('dateArrivee');
        $nouvelleReservation['utilisateur'] = $this->requete->getParametre('utilisateur');
        $nouvelleReservation['chambre'] = $this->requete->getParametre('chambre');
        

                    try {
                        $this->reservation->insertionReservation($nouvelleReservation);
                        $msgInfo = "succesNouv";
                    } catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                    }
                
    $this->executerAction('index');
}}