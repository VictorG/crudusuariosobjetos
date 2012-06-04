<?php
/*
 * 
 */

require_once('functions_db_abstract.php');
require_once('functions_array_interface.php');

class dbConnect 
extends dbConnectAbstract 
implements arrayInterface
{

	public function connectDBServer($config)
	{
	    $link =  mysql_connect($config['host'], $config['userdb'],$config['passdb']);
	    if (!$link) {
	        die('No pudo conectarse: ' . mysql_error());
	    }
	    mysql_set_charset('utf8',$link);
	    
	    $this->selectDB($config);
	    return $link;
	}
	
	protected function selectDB($config)
	{
	    mysql_select_db($config['db']);
	    return;
	}
	
	public function queryInsert($sql)
	{
	    $result = mysql_query($sql);
	    return mysql_insert_id();
	}
	
	public function query($sql)
	{
	    $result = mysql_query($sql);
	    return $result;
	}
	
	public function disconnectDBServer()
	{
	    mysql_close($this->link);
	}
	
	public function arrayAssoc($result)
	{    
	    return mysql_fetch_assoc($result);
	}
	
	public function resultToArray($result)
	{
	    $array=array();
	    while ($row = $this->arrayAssoc($result))
	    {
	        $array[]=$row;
	    }
	    return $array;
	}
	
	protected function countResults()
	{
		return;
	}
}
?>

