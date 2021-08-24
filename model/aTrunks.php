<?php
class aTrunks extends EntidadBase{
    public $trunkid;
    public $name;
    public $tech;
    public $outcid;
    public $keepcid;
    public $maxchans;
    public $failscript;
    public $dialoutprefix;
    public $channelid;
    public $usercontext;
    public $provider;
    public $disabled;
    public $continue;
    
    public function __construct() {
		global $FG;
        $table="trunks";
        parent::__construct($table, $FG['adapter_a']);
    }
	
	public function isValid(){
		return (int) $this->trunkid > 0;
	}

	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
			
		}
	}
}
?>