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
require_once ($_SESSION['config']['models']."/usuarios.php");

class usuariosController
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
		$this->datos = usuariosModel::initUserData();
		$this->{$this->route['action']."Action"}();
		echo $this->render();
		return;
	}
	
	public function selectAction()
	{
		$usuarios=usuariosModel::readUsers($this->db);
		$this->viewVar=array('usuarios'=>$usuarios,'helper'=>$_SESSION['config']['helpers']);
		return;
	}
	
	public function insertAction()
	{
		if (isset($_POST['usuario']))
		{
			// Procesar formulario de insert
			usuariosModel::procesar($this->db, $_SESSION['config']['usersUploadDirectory']."/images");
			header("Location: ?controller=usuarios&action=select");
		}
		else
		{
			//Mostrar formulario
			$this->viewVar=array('usuario'=>'','datos'=>$this->datos,'db'=>$this->db,'helper'=>$_SESSION['config']['helpers']);
		}
	}
	public function updateAction()
	{
		if (isset($_POST['usuario']))
		{
			// Procesar formulario de insert
			usuariosModel::procesarUpdate($this->db, $_SESSION['config']['usersUploadDirectory']."/images");			
			header("Location: ?controller=usuarios&action=select");
		}
		else
		{
			$this->datos=usuariosModel::readUserData($this->db, $_SESSION['config']['usersUploadDirectory']."/images");
			$this->viewVar=array('usuario'=>$_GET['usuario'],'datos'=>$this->datos,'db'=>$this->db,'helper'=>$_SESSION['config']['helpers']);
		}
	}
	public function deleteAction()
	{
		if (isset($_POST['usuario']))
		{
			// Procesar formulario de insert
			if ($_POST['delete']=='Si')
				usuariosModel::procesarDelete($this->db, $_SESSION['config']['usersUploadDirectory']."/images");
			header("Location: ?controller=usuarios&action=select");
		}
		else
		{
			$usuarios=usuariosModel::readUserById($this->db, $_GET['usuario']);
			$this->viewVar=array('usuarios'=>$usuarios,'helper'=>$_SESSION['config']['helpers']);
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