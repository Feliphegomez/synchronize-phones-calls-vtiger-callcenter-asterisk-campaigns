<?php
class CampaignExternalURL extends EntidadBase{
    public $id;
    public $urltemplate;
    public $description;
    public $active;
    public $opentype;
    
    public function __construct() {
		global $FG;
        $table="campaign_external_url";
        parent::__construct($table, $FG['adapter_c']);
    }
	
	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
			
		}
	}
	
	public function isValid(){
		return (int) $this->id > 0;
	}

}
?>