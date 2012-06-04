<?php
/*
 * input: $array es un array que voy a dibujar
 * output: $salida es un string con la tabla html
 */

class authModel
{
	
	public function procesar($db)
	{
	    $sql="SELECT * FROM usuarios 
	                  WHERE email='".$_POST['email']."' 
	                  AND password='".$_POST['password']."'";
	            $result = $db->query($sql);
	            $usuarios=$db->resultToArray($result);
	    if(isset($usuarios[0]))
	    {
	    	$_SESSION['sessionIdUsuario']=$usuarios[0]['idusuarios'];	
	    	return $usuarios[0];
	    }
	    else 
	    {	
	    	if(isset($_SESSION['sessionIdUsuario']))
	    		unset($_SESSION['sessionIdUsuario']);
	    	return null;
	    }
	}
	
	public function initUserData()
	{
	    $datos=array('name'=>'',
	             'lastname'=>'',
	             'email'=>'',
	             'description'=>'Escriba aqui sus datos por favor',
	             'id'=>'',
	             'birthday'=>'',
	             'gender'=>'',
	             'likes'=>'',
	             'transports'=>'',
	             'country'=>'',
	             'city'=>''              
	    );
	    return $datos;
	}
	
	public function readUserData($db, $proyecto)
	{
	    $usuario=$_GET['usuario'];        
	            // Leer datos de usuario de la db segun seleccion
	            $sql="SELECT usuarios.*, countries.* 
	                FROM usuarios, countries, cities
	                WHERE idusuarios=".$usuario." AND
	                usuarios.cities_idcities = cities.idcities AND
	                cities.countries_idcountries = countries.idcountries";      
	
	            $result = $db->query($sql);  
	            $arr=$db->arrayAssoc($result);
	
	            // Procesar gustos
	            $sql="SELECT usuarios_idusuarios, likes_idlikes, likes.like 
	                FROM usuarios_has_likes, likes 
	                WHERE usuarios_idusuarios=".$usuario." AND 
	                    usuarios_has_likes.likes_idlikes=likes.idlikes"
	                    ;        
	    //        echo $sql;
	    //        die;
	            $result = $db->query($sql); 
	            $arrLikes=$db->resultToArray($result);
	
	            foreach($arrLikes as $key => $values)
	            {
	                $likes[]=$values['likes_idlikes'];
	            }
	
	            $likes=implode(',',$likes);
	
	            $datos=array('name'=>$arr['name'],
	                    'password'=>$arr['password'],
	                    'lastname'=>$arr['lastname'],
	                    'email'=>$arr['email'],
	                    'description'=>$arr['description'],
	                    'id'=>$arr['idusuarios'],
	                    'birthday'=>$arr['birthday'],
	                    'gender'=>$arr['genders_idgenders'],
	                    'likes'=>$likes,
	                    'transports'=>$arr['transports'],                
	                    'city'=>$arr['cities_idcities'],
	                    'country'=>$arr['idcountries'],
	                    'photo'=>$proyecto."/".$arr['photo'],
	            );
	            return $datos;
	}
}
?>

