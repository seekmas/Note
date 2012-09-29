<?php

class KeepData{
	
	protected $str;
	
	public function __construct()
	{
		$this->str = 'Hello Moto';
	}
	
	public function say()
	{
		return print $this->str;
	}
}	