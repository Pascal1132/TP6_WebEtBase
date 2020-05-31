<?php
require_once 'Framework/Vue.php';
require_once 'Modele/Reservation.php';
require_once 'Modele/Chambre.php';
require_once 'Modele/Utilisateur.php';
require_once 'Modele/Outils.php';
require_once 'Framework/Controleur.php';


class ControleurReservations extends Controleur
{
	/*
	 * Constructeur de ControleurReservations
	 */
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

}
