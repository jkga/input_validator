<?php
/**
 * @package Php input validator class
 * @author jkga <https://github.com/jkga>
 */

namespace validator;
/* class php input_validator */

class input_validator{

	#return 1 if has error:0
	static $referenceError=0;
	static $message=[];
	static $saved_data=[];

	#constructor
	function __construct(){ }
	function __toString(){
		foreach ($this->message as $key => $value) {
			$message=$this->message[$key];
		}

		return $message;
	}
	
	#read custom message
	public function read($i=''){

		if($i==''){
			
			#return chained function
			$messageInChainedFunction=[];

			#loop in each writen message
			$x=0;
			foreach ($this->message as $key => $value) {
				$messageInChainedFunction[]=$this->message[$key];
				#add an integer index alongside defined key
				$this->message[$x]=$this->message[$key];
				$x++;
			}

			$messageInChainedFunction=$this->message;
			return $messageInChainedFunction;

		}else{

			#search in message stack
			if(array_key_exists($i, $this->message)){
				return $this->message[$i];
			} 	
		} 	
		
	}

	#write custom message
	public function write($err,$mess,$clone=false){

		#read the message in current chain method
		if(!$clone){
			$this->message[$err]=$mess;
			return $this; 	
		}else{

			$clone=clone($this);
			$clone->message=[];
			$clone->message[$err]=$mess;
			return $clone;
		}   
		
	}


	#clear custom messages
	public function clear(){
		
		$this->message=[];
		return $this; 
	}



	

}

?>