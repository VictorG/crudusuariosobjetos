<?php
$config=array(
    /* -------- Directories ------------------ */        
    "layout"        => "../application/layouts/basic/layout.phtml",
    "controllers"   => "../application/controllers",
    "views"         => "../application/views",
    "models"         => "../application/model",
    "helpers"       => "/../application/views/helpers",   
	"libs"        	=> "/../libs", 
    
    "styles"        => "/styles",           // Styles directory
    "layouts"       => "/layouts",          // Layouts directory
    "scripts"       => "/scripts",          // Scripts directory
    "assets"        => "/assets",           // Assets directory
    "usersUploadDirectory"  => "/uploads/users",
    
    /* -------- Database ------------------ */    
    "db"=>array(
			"host"          => "localhost",
		    "userdb"        => "root",
		    "passdb"        => "",
		    "db"            => "usuarios"
    )    
);

?>