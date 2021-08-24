<?php
class vCampaign extends EntidadBase{
    public $campaignid;
    public $campaign_no;
    public $campaignname;
    public $campaigntype;
    public $campaignstatus;
    public $expectedrevenue;
    public $budgetcost;
    public $actualcost;
    public $expectedresponse;
    public $numsent;
    public $product_id;
    public $sponsor;
    public $targetaudience;
    public $targetsize;
    public $expectedresponsecount;
    public $expectedsalescount;
    public $expectedroi;
    public $actualresponsecount;
    public $actualsalescount;
    public $closingdate;
    public $tags;
    public $campaign_callcenter                     = null;
    
    public function __construct() {
		global $FG;
        $table="vtiger_campaign";
        parent::__construct($table, $FG['adapter_v']);
    }
	
	public function isValid(){
		return (int) $this->campaignid > 0;
	}

	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
			$this->campaign_callcenter = new Campaign();
			$this->campaign_callcenter->getByLike('script', "CV_{$this->campaignid}");
			//$this->setAll();
		}
	}
	
	public function getAllLeadAddress($campaignid){
		$resultSet = [];
		$query = $this->db()->query("SELECT 
			`LA`.*
		FROM 
			`vtiger_campaignleadrel` `C`
		LEFT JOIN `vtiger_leadaddress` `LA`
		ON `LA`.`leadaddressid`=`C`.`leadid`
		WHERE `C`.`campaignid`={$campaignid}
		");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet[] = $row;
			}
		}
		return $resultSet;
	}
	
	public function getLeadAddressPagination($campaignid, $page, $limit){
		$init = ($page * $limit) - $limit;
		$resultSet = [];
		$query = $this->db()->query("SELECT 
			`LA`.*
		FROM 
			`vtiger_campaignleadrel` `C`
		LEFT JOIN `vtiger_leadaddress` `LA`
		ON `LA`.`leadaddressid`=`C`.`leadid`
		WHERE `C`.`campaignid`={$campaignid} LIMIT {$init}, {$limit}
		");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet[] = $row;
			}
		}
		return $resultSet;
	}
	
	public function countLeadAddress($campaignid){
		$resultSet = 0;
		$query = $this->db()->query("SELECT 
			COUNT(`LA`.`leadaddressid`) AS `total`
		FROM 
			`vtiger_campaignleadrel` `C`
		LEFT JOIN `vtiger_leadaddress` `LA`
		ON `LA`.`leadaddressid`=`C`.`leadid`
		WHERE `C`.`campaignid`={$campaignid}
		");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet = $row->total;
			}
		}
		return $resultSet;
	}
	
	public function countContactAddress($campaignid){
		$resultSet = 0;
		$query = $this->db()->query("SELECT 
			COUNT(`CD`.`contactid`) AS `total`
		FROM 
			`vtiger_campaigncontrel` `C`
		LEFT JOIN `vtiger_contactdetails` `CD`
		ON `CD`.`contactid`=`C`.`contactid`
		WHERE `C`.`campaignid`={$campaignid}
		");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet = $row->total;
			}
		}
		return $resultSet;
	}
	
	public function getAllContactAddress($campaignid){
		$resultSet = [];
		$query = $this->db()->query("SELECT 
			`CS`.*
		FROM 
			`vtiger_campaigncontrel` `C`
		LEFT JOIN `vtiger_contactdetails` `CA` ON `CA`.`contactid`=`C`.`contactid`
		LEFT JOIN `vtiger_contactsubdetails` `CS` ON `CS`.`contactsubscriptionid`=`C`.`contactid`
		WHERE `C`.`campaignid`={$campaignid}
		");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet[] = $row;
			}
		}
		return $resultSet;
	}
	
	public function getContactAddressPagination($campaignid, $page, $limit){
		$init = ($page * $limit) - $limit;
		$resultSet = [];
		$query = $this->db()->query("SELECT 
			`CS`.*
		FROM 
			`vtiger_campaigncontrel` `C`
		LEFT JOIN `vtiger_contactdetails` `CA` ON `CA`.`contactid`=`C`.`contactid`
		LEFT JOIN `vtiger_contactsubdetails` `CS` ON `CS`.`contactsubscriptionid`=`C`.`contactid`
		WHERE `C`.`campaignid`={$campaignid} LIMIT {$init}, {$limit}
		");
		if($query !== false){
			while ($row = $query->fetch_object()) {
				$resultSet[] = $row;
			}
		}
		return $resultSet;
	}
	
}
?>