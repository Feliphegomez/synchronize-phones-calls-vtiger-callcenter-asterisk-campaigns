<?php
class CampaignController extends ControladorBase{
    public $conectar_c;
	public $adapter_c;
	public $conectar_v;
	public $adapter_v;
	
    public function __construct() {
        parent::__construct(); 
        $this->conectar_c = new Conectar();
        $this->adapter_c  = $this->conectar_c->conexion();
        $this->conectar_v = new vConectar();
        $this->adapter_v  = $this->conectar_v->conexion();
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
	
	public function editar(){
		$_REQUEST['campaign'] = !isset($_REQUEST['campaign']) ? 0 : $_REQUEST['campaign'];
        $campaign = new Campaign(); // Creamos el objeto Campaign
		$campaign->getById($_REQUEST['campaign']);
		if($campaign->isValid()){
			$campaign_external_url = new CampaignExternalURL(); // Creamos el objeto CampaignExternalURL
			$campaign_form = new Form(); // Creamos el objeto Form
			$asterisk_trunks = new aTrunks(); // Creamos el objeto aTrunks
			$asterisk_queues_config = new aQueuesConfig(); // Creamos el objeto aQueuesConfig
			$this->view("edit-campaign-from-vtiger",array(
				"campaign" => $campaign,
				"vcampaign_id" => $_REQUEST['vcampaign'],
				"external_urls" => $campaign_external_url->getAll(),
				"forms" => $campaign_form->getAll(),
				"trunks" => $asterisk_trunks->getAll(),
				"queues" => $asterisk_queues_config->getAll(),
			));			
		}
		else header( "Refresh:0; url=".Helper::url("vCampaign","index"), true, 303);
		
	}
	
	public function nuevo(){
		$campaign_external_url = new CampaignExternalURL(); // Creamos el objeto CampaignExternalURL
		$campaign_form = new Form(); // Creamos el objeto Form
		$asterisk_trunks = new aTrunks(); // Creamos el objeto aTrunks
		$asterisk_queues_config = new aQueuesConfig(); // Creamos el objeto aQueuesConfig
		$this->view("create-campaign-from-vtiger",array(
			"vcampaign_id" => $_REQUEST['vcampaign'],
			"external_urls" => $campaign_external_url->getAll(),
			"forms" => $campaign_form->getAll(),
			"trunks" => $asterisk_trunks->getAll(),
			"queues" => $asterisk_queues_config->getAll(),
        ));
	}
	
	public function active(){
		if(
			isset($_GET["campaign"])
			&& isset($_GET["estatus"])
		){
			$campaign = new Campaign(); //Creamos una campaña
			$campaign->getById($_GET["campaign"]);
			if($campaign->isValid()){
				$campaign->changeEstatus($_GET["estatus"]);
			}
		}
        $this->redirect("vCampaign", "index");
	}
	
    public function guardar(){
		if(
			isset($_POST["id"])
			&& isset($_POST["datetime_init"])
			&& isset($_POST["datetime_end"])
			&& isset($_POST["daytime_init"])
			&& isset($_POST["daytime_end"])
			&& isset($_POST["id_url"])
			&& isset($_POST["context"])
			&& isset($_POST["max_canales"])
			&& isset($_POST["queue"])
			&& isset($_POST["retries"])
		){
			$campaign = new Campaign(); //Creamos una campaña
			$campaign->getById($_POST["id"]);
			if($campaign->isValid()){
				$campaign->datetime_init            = $_POST["datetime_init"];
				$campaign->datetime_end             = $_POST["datetime_end"];
				$campaign->daytime_init             = $_POST["daytime_init"];
				$campaign->daytime_end              = $_POST["daytime_end"];
				$campaign->id_url                   = (int) $_POST["id_url"];
				$campaign->trunk                    = $_POST["trunk"];
				$campaign->context                  = $_POST["context"];
				$campaign->max_canales              = (int) $_POST["max_canales"];
				$campaign->queue                    = $_POST["queue"];
				$campaign->retries                  = (int) $_POST["retries"];
				$save = $campaign->save();
			}
			
        }
        $this->redirect("vCampaign", "index");
	}
    
    public function crear(){
		$_POST["trunk"] = (isset($_POST["trunk"]) ? ($_POST["trunk"] == "null" ? $_POST["trunk"] = null : $_POST["trunk"]) : NULL);
        if(
			isset($_POST["name"])
			&& isset($_POST["script"])
			&& isset($_POST["datetime_init"])
			&& isset($_POST["datetime_end"])
			&& isset($_POST["daytime_init"])
			&& isset($_POST["daytime_end"])
			&& isset($_POST["id_url"])
			&& isset($_POST["form_id"])
			&& isset($_POST["context"])
			&& isset($_POST["max_canales"])
			&& isset($_POST["queue"])
			&& isset($_POST["retries"])
		){
			$campaign = new Campaign(); //Creamos una campaña
			$campaign->set("name", $_POST["name"]);
			$campaign->script                   = $_POST["script"];
			$campaign->datetime_init            = $_POST["datetime_init"];
			$campaign->datetime_end             = $_POST["datetime_end"];
			$campaign->daytime_init             = $_POST["daytime_init"];
			$campaign->daytime_end              = $_POST["daytime_end"];
			$campaign->id_url                   = (int) $_POST["id_url"];
			$campaign->form_id                  = (int) $_POST["form_id"];
			$campaign->trunk                    = $_POST["trunk"];
			$campaign->context                  = $_POST["context"];
			$campaign->max_canales              = (int) $_POST["max_canales"];
			$campaign->queue                    = $_POST["queue"];
			$campaign->retries                  = (int) $_POST["retries"];
            $save = $campaign->create();
			
        }
        $this->redirect("vCampaign", "index");
    }
    
    public function borrar(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
            
            $usuario=new Usuario();
            $usuario->deleteById($id); 
        }
        $this->redirect();
    }
    
    
    public function hola(){
        $usuarios=new CampaignModel($this->adapter);
        $usu=$usuarios->getUnUsuario();
        var_dump($usu);
    }

}
?>
