<?php
/*
 * 
 */

class dbConnect
{

	public $link = '';
	
	function __construct($config)
	{
		$this->link = $this->connectDBServer($config);
		return;
	}
	
	function __destruct()
	{
		return;
	}
	
	function connectDBServer($config)
	{
	    $link =  mysql_connect($config['host'], $config['userdb'],$config['passdb']);
	    if (!$link) {
	        die('No pudo conectarse: ' . mysql_error());
	    }
	    mysql_set_charset('utf8',$link);
	    
	    $this->selectDB($config);
	    return $link;
	}
	
	function selectDB($config)
	{
	    mysql_select_db($config['db']);
	    return;
	}
	
	function queryInsert($link, $sql)
	{
	    $result = mysql_query($sql);
	    return mysql_insert_id();
	}
	
	function query($sql)
	{
	    $result = mysql_query($sql);
	    return $result;
	}
	
	function disconnectDBServer()
	{
	    mysql_close($this->link);
	}
	
	function arrayAssoc($result)
	{    
	    return mysql_fetch_assoc($result);
	}
	
	function resultToArray($result)
	{
	    $array=array();
	    while ($row = $this->arrayAssoc($result))
	    {
	        $array[]=$row;
	    }
	    return $array;
	}
}
?>

