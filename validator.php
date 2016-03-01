<?php
/**
 * @package Php input validator class
 * @author jkga <https://github.com/jkga>
 */

namespace validator;
/* class php input_validator */

class input_validator{

	static $errors=[];
	static $message=[];
	static $result=0;
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
		#read returns singleton if called independently
		#it will only return value from chained method if called right after writing ex.$sample->write('method#1','fs from chain')->write('method#2','chained method')->read()
		
		if($i==''){
			
			#return chained function
			$messageInChainedFunction=[];

			#loop in each writen message
			$x=0;
			$message_count=count($this->message);
			foreach ($this->message as $key => $value) {

				$messageInChainedFunction[]=$this->message[$key];
				#add an integer index alongside defined key
				#check first if index is string to avoid overflow
				if(gettype($key)==='string') $this->message[$x]=$this->message[$key]; $x++;
				
			}

			$messageInChainedFunction=$this->message;
			return $messageInChainedFunction;

		}else{

			#search in message stack
			if(isset($this->message))
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


	#check if valid email
	public function email($value=array()){
		#optional pattern
		#$pattern='/^([0-9a-zA-Z\_]{3,})+@([a-z]{4,})+(.{1}[a-z]{2,3})$/i'; //old pattern
		/*(lettersornumbers may contain underscore{min of 3letters})+@(letters{min 4})
		+(.{max 1 dot})(letters(min 0f 2,max of 3))*/
			
			$this->name='email';	
			$this->data=$value;
			$this->result=1;
		
		foreach ($value as $key => $val) {
			
			if(filter_var($val,FILTER_VALIDATE_EMAIL)){
				#if(isset(self::$errors['email'])) unset(self::$errors['email']);
			
			}else{#self::$referenceError=1;
				$this->error[$key]=$val.' is not a valid email address';
				self::$errors['email'][$key]=$this->error[$key];
				$this->result=0;
			}


		}

		return $this;


	}

	#check if exist in data
	public function contained_in($set=array()){

		$this->name='contain';
		$this->result=0;
		foreach ($this->data as $key => $val) {
			#$this->result=0;
			self::$errors['contain'][$key]=$val.' does not contained in set';
			if(in_array($this->data[$key],$set)){
				$this->result=1;
				unset(self::$errors['contain']);
				break;
			}

			
		}
		 
		return $this;

	}






	

}

?>
