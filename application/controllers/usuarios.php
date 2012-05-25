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
require_once ($config['models']."/usuarios.php");

/**
 * Settings iniciales 
 */
$datos=initUserData();

/**
 * Inicializacion de variables 
 */
$usuario='';
$content='';
$route=route('usuarios', 'select');     

/**
 * Parametrizar 
 */

/**
 * Procesar 
 */
$link=connectDBServer($config);
switch($route['action'])
{
    case 'delete':
        if (isset($_POST['usuario']))
        {
            // Procesar formulario de insert            
            if ($_POST['delete']=='Si')
                procesarDelete($config['usersUploadDirectory']."/images", $config);
            header("Location: ?controller=usuarios&action=select"); 
            break;
        }
        else
        {
            $usuarios=readUserById($link, $_GET['usuario']);
            $viewVar=array('usuarios'=>$usuarios,'helper'=>$config['helpers']);     
        }
    break;    
    case 'update':       
        if (isset($_POST['usuario']))
        {
            // Procesar formulario de insert            
            procesarUpdate($config['usersUploadDirectory']."/images", $config);
            header("Location: ?controller=usuarios&action=select"); 
            break;
        }
        else
        {
            $datos=readUserData($link, $config['usersUploadDirectory']."/images");
        }        
    case 'insert':
        // Si POST          
        if (isset($_POST['usuario']))
        {
            // Procesar formulario de insert
            procesar($config['usersUploadDirectory']."/images", $config);
            header("Location: ?controller=usuarios&action=select");            
        }
        else
        {
            //Mostrar formulario
            $viewVar=array('usuario'=>'','datos'=>$datos,'link'=>$link,'helper'=>$config['helpers']);           
        }                             
    break;
    case 'select':
    default:   
        $usuarios=readUsers($link);
        $viewVar=array('usuarios'=>$usuarios,'helper'=>$config['helpers']);
    break;
}
/**
 * Mostrar 
 */
$content=view($viewVar, $config['views'].'/'.$route['controller'].'/'.$route['action'].'.phtml');
disconnectDBServer($link);
?>