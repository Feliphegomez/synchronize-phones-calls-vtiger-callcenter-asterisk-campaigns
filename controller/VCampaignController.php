<?php
class vCampaignController extends ControladorBase{
    public $conectar_c;
	public $adapter_c;
	public $conectar_v;
	public $adapter_v;
	
    public function __construct() {
        parent::__construct(); 
    }
    
    public function index(){
        $campaign_c = new Campaign(); // Creamos el objeto Campaign
        $campaigns_c = $campaign_c->getAll(); // Conseguimos todas las campañas del call center
		
        $campaign_v = new vCampaign(); // Campañas de vTiger
		$campaigns_v = $campaign_v->getAll();
       
        //Cargamos la vista index y le pasamos valores
        $this->view("index",array(
            "campaigns_v" => $campaigns_v,
			"campaigns_c" => $campaigns_c,
        ));
    }
	
}
?>
