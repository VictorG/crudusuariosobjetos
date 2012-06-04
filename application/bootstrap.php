<?php
/**
 * Bootstrap
 *
 * Bootstrap application.
 * 
 * @uses       none
 * @package    Bootstrap
 * @subpackage application
 */

/**
 * Settings iniciales 
 */


/**
 * Procesar 
 */
class bootstrap
{

	public $route='';
	public $content='';
	public $renderview='';	
	
	public function __construct($config)
	{
		session_start();
		$_SESSION['config']=$config;
		
		require_once ("../libs/functions_db.php");
		require_once ("../libs/functions_views.php");
		require_once ("../libs/functions_mvc.php");
				
		$this -> _init();
		return;
	}
	public function __destruct()
	{
		
	}
	
	protected function _init()
	{
		$route = mvc::getInstance();
		$route->setDefaultRoute('usuarios', 'select');		
		$this -> route = $route->getRoute();
		return;
	}
	
	public function run()
	{		
		include_once($_SESSION['config']['controllers'].'/auth.php');
		$obj = new authController();
		echo views::render($this->content, $_SESSION['config']['layout']);
	}
	
}



// switch ($renderview)
// {
//     case 'file':
//         echo "<pre>";
//         print_r("Esto es file");
//         echo "</pre>";
//         include_once($config['controllers'].'/'.$_GET['controller'].'.php');
//         $obj = new usuariosController();
        
//     break;
//     case 'error':
//         header("Status: 404 Not Found");
//         echo "<pre>";
//         print_r("Esto es error");
//         echo "</pre>";        
//     break;
//     default:
//         echo "<pre>";
//         print_r("Esto es default");
//         echo "</pre>";
//         $content="<ul><li><a href=\"?controller=usuarios\">usuarios</a></li></ul>";
//     break;
// }

// /**
//  * Mostrar 
//  */
// echo views::render($content, $config['layout']);
        
?>


