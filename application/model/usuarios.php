<?php
/*
 * input: $array es un array que voy a dibujar
 * output: $salida es un string con la tabla html
 */


function procesarUpdate($proyecto, $config)
{
    $link=connectDBServer($config);
    //Actualizar imagen
    
    //Actualizar tabla de usuarios_has_likes
    
    //Actualizar tabla de usuarios
    
     /* ------------------------------------ */
 
    //Si imagen en el update
    if($_FILES['photo']['name']!='')
    {
        // Borrar imagen anterior
                    $sql="SELECT photo FROM usuarios 
                        WHERE idusuarios=".$_POST['usuario'];

                    $result=query($link, $sql);
                    $arrPhoto=arrayAssoc($result);

                    $imagen_anterior=$arrPhoto['photo'];
                    
                    unlink($_SERVER['DOCUMENT_ROOT'].
                           $proyecto."/".
                           $imagen_anterior);
        // Subir imagen nueva
                    $origen=$_FILES['photo']['tmp_name'];
                    $nombre=$_FILES['photo']['name'];

                    $out=array();

                    // Destino es la localizacion fisica en el disco duro
                    $destino=$_SERVER['DOCUMENT_ROOT'].$proyecto."/".$nombre;
                    
                    $count=0;
                    $partes_ruta=pathinfo($destino);
                    while(file_exists($destino))
                    {
                        $count++;    
                        $destino=$_SERVER['DOCUMENT_ROOT'].$proyecto."/".
                        $partes_ruta['filename']."-".
                        $count.".".$partes_ruta['extension'];
                    }
                    if($count==0)
                    {
                        // Esta es la ruta en la URL
                        $imagen=$partes_ruta['filename'].".".$partes_ruta['extension'];
                    }
                    else
                        $imagen=$partes_ruta['filename']."-".$count.".".$partes_ruta['extension'];
                   
                    move_uploaded_file($origen,$destino);
                    $out['photo']=$imagen;        
   }
   
   // Crear array out

                    foreach($_POST as $key => $value)
                    {
                        if(is_array($value))
                            $out[$key]=implode(',',$value);
                        else
                            $out[$key]=$value;
                    }
                    
   // Actualizar tabla de usuarios       
        
                    $sql="UPDATE usuarios SET
                            email = '".$out['email']."',            
                            name = '".$out['name']."',
                            lastname = '".$out['lastname']."',
                            birthday = '".$out['birthday']."',";
                     if(isset($out['photo']))
                            $sql.="photo = '".$out['photo']."',"; 
                     $sql.="description = '".$out['description']."',
                            cities_idcities = ".$out['city'].",
                            genders_idgenders = ".$out['gender'].",
                            transports =  '".$out['transports']."' 
                        WHERE idusuarios =".$out['usuario']."";
                     
                    $result=query($link, $sql);
    
    // Actualizar tabla de usuarios_has_likes
    
    
                    // Borrar todos los datos del usuario                    
                    $sql="DELETE FROM usuarios_has_likes 
                          WHERE usuarios_idusuarios = ".$out['usuario'];
                    query($link, $sql);
                    // Insertar todos los datos del usuario
                    $likes=explode(',', $out['likes']);
                    foreach ($likes as $key => $value)
                    {
                        $sql="INSERT INTO usuarios_has_likes SET
                                usuarios_idusuarios = ".$out['usuario'].",
                                likes_idlikes = ".$value;
                        query($link, $sql);
                    }
                    
    return $out['usuario'];
}
function procesar($proyecto,$config)
{
    
    if($_FILES['photo']['name']!='')
        {
                //Procesar insert

                /* ------------------------------------ */
                $origen=$_FILES['photo']['tmp_name'];
                $nombre=$_FILES['photo']['name'];

                $out=array();

                // Destino es la localizacion fisica en el disco duro
                $destino=$_SERVER['DOCUMENT_ROOT']."/".$proyecto."/".$nombre;

                $count=0;
                $partes_ruta=pathinfo($destino);
                while(file_exists($destino))
                {
                    $count++;    
                    $destino=$_SERVER['DOCUMENT_ROOT']."/".$proyecto."/".
                    $partes_ruta['filename']."-".
                    $count.".".$partes_ruta['extension'];
                }
                if($count==0)
                {
                    // Esta es la ruta en la URL
                    $imagen=$partes_ruta['filename'].".".$partes_ruta['extension'];
                }
                else
                    $imagen=$partes_ruta['filename']."-".$count.".".$partes_ruta['extension'];

                move_uploaded_file($origen,$destino);
                $out['photo']=$imagen;                
        }
        
        foreach($_POST as $key => $value)
        {
            if(is_array($value))
                $out[$key]=implode(',',$value);
            else
                $out[$key]=$value;
        }
        
        // Hacer el insert
        $link=connectDBServer($config);
        $sql="INSERT INTO usuarios SET
            email = '".$out['email']."',
            password = '".$out['password']."',
            name = '".$out['name']."',
            lastname = '".$out['lastname']."',
            birthday = '".$out['birthday']."',
            photo = '".$out['photo']."', 
            description = '".$out['description']."',
            cities_idcities = ".$out['city'].",
            genders_idgenders = ".$out['gender'].",
            transports =  '".$out['transports']."'"; 

        $result=queryInsert($link, $sql);
     
        $likes=explode(',', $out['likes']);
        foreach ($likes as $key => $value)
        {
            $sql="INSERT INTO usuarios_has_likes SET
                    usuarios_idusuarios = ".$result.",
                    likes_idlikes = ".$value;
            query($link, $sql);
        }

        return $result;
        
  

}

function procesarDelete($proyecto)
{
    // Crear array out
                    $out=array();
                    foreach($_POST as $key => $value)
                    {
                        if(is_array($value))
                            $out[$key]=implode(',',$value);
                        else
                            $out[$key]=$value;
                    }       

    // Borrar imagen 
                    $sql="SELECT photo FROM usuarios 
                        WHERE idusuarios=".$out['usuario'];

                    $result=query($link, $sql);
                    $arrPhoto=arrayAssoc($result);

                    $imagen_anterior=$arrPhoto['photo'];
                    
                    unlink($_SERVER['DOCUMENT_ROOT'].
                           $proyecto."/".
                           $imagen_anterior);
     // Borrar todos datos en usuarios_has_likes                   
                    $sql="DELETE FROM usuarios_has_likes 
                          WHERE usuarios_idusuarios = ".$out['usuario'];
                    query($link, $sql);
    // Borrar todos los datos del usuario                    
                    $sql="DELETE FROM usuarios 
                          WHERE idusuarios = ".$out['usuario'];
                    query($link, $sql);
                    
    return $out['usuario'];
}
/*-------------------------------------------------------------------------*/

function readUsers($link)
{
    $sql="SELECT * FROM usuarios";
    $result = query($link, $sql);
    $usuarios=resultToArray($result);
    return $usuarios;
}

function readUsersById($link, $id)
{
    $sql="SELECT * FROM usuarios 
                  WHERE idusuarios=".$id;
            $result = query($link, $sql);
            $usuarios=resultToArray($result);
    return $usuarios;
}

function initUserData()
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

function readUserData($link, $proyecto)
{
    $usuario=$_GET['usuario'];        
            // Leer datos de usuario de la db segun seleccion
            $sql="SELECT usuarios.*, countries.* 
                FROM usuarios, countries, cities
                WHERE idusuarios=".$usuario." AND
                usuarios.cities_idcities = cities.idcities AND
                cities.countries_idcountries = countries.idcountries";      

            $result = query($link, $sql);  
            $arr=arrayAssoc($result);

            // Procesar gustos
            $sql="SELECT usuarios_idusuarios, likes_idlikes, likes.like 
                FROM usuarios_has_likes, likes 
                WHERE usuarios_idusuarios=".$usuario." AND 
                    usuarios_has_likes.likes_idlikes=likes.idlikes"
                    ;        
    //        echo $sql;
    //        die;
            $result = query($link, $sql); 
            $arrLikes=resultToArray($result);

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
?>

