<?php
/**
 * Auth controller
 *
 * Controller for authentication.
 * 
 * @uses       none
 * @package    Auth
 * @subpackage Controller
 */
/**
 * Incluir librerias 
 */
require_once ($_SESSION['config']['models']."/auth.php");

class authController
{
	public $db='';
	public $usuario='';
	public $content='';
	public $route=''; 
	public $datos='';
	public $viewVar='';
	
	public function __construct()
	{
		$this -> db = new dbConnect($_SESSION['config']['db']);
		$obj = mvc::getInstance();
// 		$this -> route = $obj->setRoute('usuarios', 'select');
		$this -> route = $obj->getRoute();	
		$this -> _init();		
		return;
	}
	
	public function __destruct()
	{
		
// 		echo $this->render();
// 		echo "caca";
	}
	
	/**
	 * Inicializacion de variables
	 */
	protected function _init()
	{
		$this->datos = authModel::initUserData();
		$this->{$this->route['action']."Action"}();
		echo $this->render();
		return;
	}
	
	public function loginAction()
	{
		if (isset($_POST['password']))
		{
			// Procesar formulario de insert
			$usuario=authModel::procesar($this->db);
			
			// Esta logueado
			if(isset($_SESSION[sessionIdUsuario]))
				header("Location: ?controller=usuarios&action=select");
			// No esta logueado
			else
				header("Location: ?controller=auth&action=login");
			
			
		}
		else
		{
			//Mostrar formulario
			$this->viewVar=array('usuario'=>'','datos'=>$this->datos,'db'=>$this->db,'helper'=>$_SESSION['config']['helpers']);
		}
	}
	
	/**
	 * Mostrar
	 */	
	public function render()
	{
		$content=views::view($this->viewVar, $_SESSION['config']['views'].'/'.$this->route['controller'].'/'.$this->route['action'].'.phtml');
		$this->db->disconnectDBServer();
		return $content;
	}
}



?>