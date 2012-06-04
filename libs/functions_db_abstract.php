<?php
/*
 * 
 */

abstract class dbConnectAbstract
{

	public $link = '';
	
	public function __construct($config)
	{
		$this->link = $this->connectDBServer($config);
		return;
	}
	
	public function __destruct()
	{
		return;
	}
	
	abstract public function connectDBServer($config);	
	
	abstract protected function selectDB($config);
		
	abstract public function queryInsert($sql);
		
	abstract public function query($sql);
	
	abstract public function disconnectDBServer();
		
	abstract protected function countResults();
	
	
}
?>

