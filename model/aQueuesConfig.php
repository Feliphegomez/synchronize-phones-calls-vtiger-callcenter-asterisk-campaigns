<?php
class aQueuesConfig extends EntidadBase{
    public $extension;
    public $descr;
    public $grppre;
    public $alertinfo;
    public $ringing;
    public $maxwait;
    public $password;
    public $ivr_id;
    public $dest;
    public $cwignore;
    public $qregex;
    public $agentannounce_id;
    public $joinannounce_id;
    public $queuewait;
    public $use_queue_context;
    public $togglehint;
    public $qnoanswer;
    public $callconfirm;
    public $callconfirm_id;
    public $monitor_type;
    public $monitor_heard;
    public $monitor_spoken;
    public $callback_id;
    public $destcontinue;
    
    public function __construct() {
		global $FG;
        $table="queues_config";
        parent::__construct($table, $FG['adapter_a']);
    }
	
	public function isValid(){
		return (int) $this->extension > 0;
	}

	public function setAll($data){
		parent::setAll($data);
		if($this->isValid()){
			
		}
	}
}
?>