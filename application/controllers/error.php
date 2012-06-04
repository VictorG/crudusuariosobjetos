<?php
/**
 * Usuarios controller
 *
 * Controller for application usuarios.
 * 
 * @uses       none
 * @package    Usuarios
 * @subpackage Controller
 */
/**
 * Incluir librerias 
 */
require_once ($_SESSION['config']['libs']."/function_error_interface.php");

class errorController implements mvcErrorInterface
{	
	public $content='';
	public $route=''; 
	public $viewVar='';
	
	public function __construct()
	{
		$this -> route = mvc::route('error', 'error');	
		$this -> _init();		
		return;
	}
	
	protected function _init()
	{

		$this->{$this->route['action']."Action"}();
		echo $this->render();
		return;
	}
	
	public function actionNotFoundAction()
	{
		return;
	}
	
	public function controllerNotFoundAction()
	{
		return;
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