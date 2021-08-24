<?php
class PhoneBookController extends ControladorBase{
    public $conectar_c;
	public $adapter_c;
	public $conectar_v;
	public $adapter_v;
	
    public function __construct() {
        parent::__construct(); 
    }
    
    public function index(){
		if(
			isset($_GET["campaign"])
			&& isset($_GET["vcampaign"])
		){
			$campaign = new Campaign(); // Creamos el objeto Campaign
			$vcampaign = new vCampaign(); // Creamos el objeto Campaign
			$campaign->getById($_GET["campaign"]);
			$phone_book = [];
			$limit = 100;
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$module = isset($_GET['module']) ? $_GET['module'] : "Leads";
			$leadaddress_count = $vcampaign->countLeadAddress($_GET["vcampaign"]);
			$contactaddress_count = $vcampaign->countContactAddress($_GET["vcampaign"]);
			
			
			if(isset($_GET['start']) && $_GET['start'] == 'true'){
				switch($module){
					case 'Contacts':
						$contactaddress_pages = $contactaddress_count / $limit;
						$contactaddress_pages = $contactaddress_pages > (int) $contactaddress_pages ? ((int) $contactaddress_pages)+1 : (int) $contactaddress_pages;
						if($page > $contactaddress_pages) $page = $contactaddress_pages;
						
						foreach($vcampaign->getContactAddressPagination($_GET["vcampaign"], $page, $limit) as $contact){
							if(!empty($contact->homephone)){
								$call = new Calls();
								$call->set('id_campaign', $campaign->get('id'));
								$call->set('phone', $contact->homephone);
								$call->save();
								if($call->isValid()){
									$call->insertAttr('VTIGER_CAMPAIGN_ID', $campaign->get('id'), 1);
									$call->insertAttr('VTIGER_MODULE', 'Contacts', 2);
									$call->insertAttr('VTIGER_VIEW', 'Edit', 3);
									$call->insertAttr('VTIGER_RECORD_ID', $contact->contactsubscriptionid, 4);
									$call->insertAttr('VTIGER_APP', "MARKETING", 5);
								}
								$phone_book[] = $call;
							}
							if(!empty($contact->otherphone)){
								$call = new Calls();
								$call->set('id_campaign', $campaign->get('id'));
								$call->set('phone', $contact->otherphone);
								$call->save();
								if($call->isValid()){
									$call->insertAttr('VTIGER_CAMPAIGN_ID', $campaign->get('id'), 1);
									$call->insertAttr('VTIGER_MODULE', 'Contacts', 2);
									$call->insertAttr('VTIGER_VIEW', 'Edit', 3);
									$call->insertAttr('VTIGER_RECORD_ID', $contact->contactsubscriptionid, 4);
									$call->insertAttr('VTIGER_APP', "MARKETING", 5);
								}
								$phone_book[] = $call;
							}
						}
						if($page < $contactaddress_pages) $url_redirect = Helper::url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}&start=true&module=Contacts&page=".($page+1);
						else $url_redirect = Helper::url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}";
						header( "Refresh:0; url={$url_redirect}", true, 303);
						break;
					case 'Leads':
						$leadaddress_pages = $leadaddress_count / $limit;
						$leadaddress_pages = $leadaddress_pages > (int) $leadaddress_pages ? ((int) $leadaddress_pages)+1 : (int) $leadaddress_pages;
						if($page > $leadaddress_pages) $page = $leadaddress_pages;
						
						foreach($vcampaign->getAllLeadAddress($_GET["vcampaign"], $page, $limit) as $lead){
							if(!empty($lead->phone)){
								$call = new Calls();
								$call->set('id_campaign', $campaign->get('id'));
								$call->set('phone', $lead->phone);
								$call->save();
								if($call->isValid()){
									$call->insertAttr('VTIGER_CAMPAIGN_ID', $campaign->get('id'), 1);
									$call->insertAttr('VTIGER_MODULE', 'Leads', 2);
									$call->insertAttr('VTIGER_VIEW', 'Edit', 3);
									$call->insertAttr('VTIGER_RECORD_ID', $lead->leadaddressid, 4);
									$call->insertAttr('VTIGER_APP', "MARKETING", 5);
								}
								$phone_book[] = $call;
							}
							if(!empty($lead->mobile)){
								$call = new Calls();
								$call->set('id_campaign', $campaign->get('id'));
								$call->set('phone', $lead->mobile);
								$call->save();
								if($call->isValid()){
									$call->insertAttr('VTIGER_CAMPAIGN_ID', $campaign->get('id'), 1);
									$call->insertAttr('VTIGER_MODULE', 'Leads', 2);
									$call->insertAttr('VTIGER_VIEW', 'Edit', 3);
									$call->insertAttr('VTIGER_RECORD_ID', $lead->leadaddressid, 4);
									$call->insertAttr('VTIGER_APP', "MARKETING", 5);
								}
								$phone_book[] = $call;
							}
						}
						if($page < $leadaddress_pages) $url_redirect = Helper::url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}&start=true&module=Leads&page=".($page+1);
						else $url_redirect = Helper::url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}";
						header( "Refresh:0; url={$url_redirect}", true, 303);
						break;
					default:
						break;
				}
			} else {
				$calls = new Calls();
				#$phone_book = $calls->getAllBy('id_campaign', $_GET["campaign"]);
			}
			
			//Cargamos la vista
			$this->view("phone_book",array(
				"module" => $module,
				"limit" => $limit,
				"page" => $page,
				"campaign" => $campaign,
				"vcampaign" => $vcampaign,
				"phone_book" => $phone_book,
				"leadaddress_count" => $leadaddress_count,
				"contactaddress_count" => $contactaddress_count,
			));
		}
		
    }
	
}
?>
