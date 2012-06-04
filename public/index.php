<?php
/**
 * Index controller
 *
 * Controller for all applications.
 * 
 * @uses       none
 * @package    Index
 * @subpackage Controller
 */

// TODO hacer algo
// Esto es algo que tendre que hacer

/**
 * Debugs 
 */
echo "<pre>GET: ";
print_r($_GET);
echo "</pre>";

echo "<pre>POST: ";
print_r($_POST);
echo "</pre>";

echo "<pre>Files: ";
print_r($_FILES);
echo "</pre>";

/**
 * Incluir librerias 
 */
require_once ("../application/configs/settings.php");
require_once ("../application/bootstrap.php");
$mvc = new bootstrap($config);
$mvc->run();

        
?>


