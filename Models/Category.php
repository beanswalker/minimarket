<?php
require_once('../Config/Connection_DB.php');
/*
 * Copyright (C) 2018 Made with love in Colombia by beanswalker
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Inherit from the Connection_DB class to initialize the connection to the Database
 * Hereda de la clase Conexion_DB para inicializar la conexión a la Base de Datos
 * @author beanswalker
 */

class Category extends Connection_DB
{
    /**
     * launch the connection with the DBMS 
     * Lanzar la Conexión con el SGBD
     */
    public function __construct()
    {
        parent::__construct();
        
    }
    /**
     * Procedure to create a new Category
     * @param string $nm
     * @param string $dscrptn
     */
    
    /**
     * Procedure to create a new Category
     * @param string $nm
     * @param string $dscrptn
     * @param int $id ... es true o false y nos sirve para cuando necesitamos obtener el id del ultimo registro ingresado
     * @param string $simple
     */
    public function new_category($nm,$dscrptn,$id)
    {
        $query = "INSERT INTO category (name,description) VALUES ('$nm','$dscrptn')";
        if($id == TRUE)
        {
            parent::simple_query($query,TRUE);
        }
        else
        {
            parent::complete_query($query);
        }
        
                
    }
    
    /**
     * *Procedure to Update a Category
     * Procedimiento para actualizar categoría
     * @param int $id_ctgry
     * @param string $nm
     * @param string $dscrptn
     */
    public function edit_category($id_ctgry,$nm,$dscrptn)
    {
        $query = "UPDATE category SET name='$nm', description='$dscrptn' WHERE idcategory='$id_ctgry'";
        parent::complete_query($query);
    }
    
    /**
     * procedure that gets an response
     * Procedimiento para obtener una respuesta
     * @return array, Object or Boolean
     */
    protected function get_response() 
    {
        
        return parent::get_response();
        
    }
    
    /**
     * Procedure that gets an error
     * @return string
     */
    protected function get_error()
    {
        return parent::get_error();
    }
    
    /**
     * Procedure that requests to break the connection with the DBMS
     * Procedimiento que solicita romper la conexión con el SGBD
     */
    protected function break_connection()
    {
        parent::break_connection();
    }    
}
////Ensayo del código, insertando nueva categoría desde este mismo archivo.
////Y verificando el rompimiento de la conexión
////(debo poner los procedimientos de la clase madre como públicos)
//// Recuerda que name es campo unique...
//$object = new Category;
//$query = $object->new_category('guantes19', 'articulos deportivos',TRUE);
//$response = $object->get_response();
//
//
//if($response == TRUE)
//{
//    
//    
//    echo'<br> Registro insertado Correctamente';
//    
//    echo '<br>respuesta:... ';
//    var_dump($object->get_response());
//    
//    $object->break_connection();
//    
//    //al intentar ralizar otra consulta vemos que no se puede...
//    $new_query = $object->new_category('chaquetas290', 'Ropa común');
//    $new_response = $object->get_response();
//    echo '<br> nueva consulta ... <br> respuesta:... ';
//    var_dump($new_response);
//    echo '<br>error:... ';
//    var_dump($object->get_error());
//    
//    
//    
//}
//else
//{
//    echo '<br> Error al insertar los Datos';
//       
//    echo '<br> respuesta:..';
//    var_dump($response);
//    echo '<br>error:... ';
//    var_dump($object->get_error());
//    
//    $object->break_connection();
//    //al intentar ralizar otra consulta vemos que no se puede...
//    $new_query = $object->new_category('chaque2', 'Ropa común');
//    $new_response = $object->get_response();
//    echo '<br> nueva consulta ... <br> respuesta:... ';
//    var_dump($new_response);
//    echo '<br>error:... ';
//    var_dump($object->get_error());
//}


