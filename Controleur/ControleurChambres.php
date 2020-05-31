<?php
require_once 'Modele/Chambre.php';
require_once 'Modele/Type.php';
require_once 'Modele/Outils.php';
require_once 'Framework/Vue.php';
require_once 'Framework/Controleur.php';

class ControleurChambres extends Controleur
{
    /*
     * Constructeur de ControleurChambres
     */
    private $chambre;
    private $typeChambre;
    private $outils;

    public function __construct()
    {
        $this->chambre=new Chambre();
        $this->typeChambre=new Type();
        $this->outils = new Outils();
    }


    public function index()
    {
        $chambreTab = $this->chambre->getChambres();
        $vue = new Vue("NouvelleChambre");
        $msgCode = "";
        if($this->requete->existeParametre('msg')){
            $msgCode = $this->requete->getParametre('msg');
        }
        $msg=$this->outils->getMessageInfo($msgCode);
        $this->genererVue(['chambresTab'=>$chambreTab, 'msg'=>$msg, 'msgCode'=>$msgCode]);
    }
}