<?php
/*
 * 
 */
class mvc 
{
	protected $defaultController='';
	protected $defaultAction='';
	public $controller;
	public $action;
	
	private static $instance;
	
	public function __contruct()
	{	
		return;
	}
	
	// Singleton definition
	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
	
		return self::$instance;
	}
	
	
	
	
	public function setDefaultRoute($controller, $action)
	{
		$this->defaultController = $controller;
		$this->defaultAction = $action;		
		$this->setRoute();
	}
	
	public function setRoute($controllerO=null, $actionO=null)
	{
	    $route=array();
	    	    
	    if(isset($controllerO))								// Si valor variable deifinido
	    	$this->controller=$controllerO;
	    elseif (isset($_GET['controller']))					// Si valor variable no definido pero si get
	    	$this->controller=$_GET['controller'];
	    else 												// Si no valor variable y no valor get
	    	$this->controller=$this->defaultController;
	    
	    if(isset($actionO))									// Si valor variable deifinido
	    	$this->action=$actionO;
	    elseif (isset($_GET['action']))						// Si valor variable no definido pero si get
	    	$this->action=$_GET['action'];
	    else 												// Si no valor variable y no valor get
	    	$this->action=$this->defaultAction;
	    
	    
	   	    
	    // Existe el controller
	    if(file_exists($_SESSION['config']['controllers']."/".$this->controller.'.php'))
	    {	    	
	    	include_once($_SESSION['config']['controllers'].'/'.$this->controller.'.php');
	    	
	    	$metodos=get_class_methods($this->controller.'Controller');
				
	    	// NO Existe la accion
	    	if(!in_array($this->action.'Action',$metodos))
	    	{
	    		$this->controller='error';
	    		$this->action='actionNotFound';
	    	}
	    }
	    // No existe el controller
	    else
	    {	    	
	    	$this->controller='error';
	    	$this->action='controllerNotFound';
	    }

	    return;
	}
	
	public function getRoute()
	{
		$route=array('controller'=>$this->controller, 
	                 'action'=>$this->action
	                 );
	    
	    return $route;
	}
}

?>

