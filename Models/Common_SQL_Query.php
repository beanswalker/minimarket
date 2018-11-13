<?php
require_once '../Config/Connection_DB.php';

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
 *
 * @author beanswalker
 */
class Common_SQL_Query extends Connection_DB 
{  
    
    public function __construct() {
        
        parent::__construct();
    }

    /**
     * Procedure To select all Records in a table
     * Procedimiento para seleccionar todos los registros de una tabla
     * @param String $table_name
     */
    public function select_all($table_name)
    {
        $query = "SELECT * FROM $table_name";
        
            parent::complete_query($query);
        
                
    }
    
    /**
     * procedure to select a record from a table
     * Procedimiento para seleccionar un registro de una tabla
     * @param int $id_ctgr
     */
    public function select_by_ID($name_table,$name_fieldID,$fieldID)
    {
        $query = "SELECT * FROM $name_table WHERE $name_fieldID='$fieldID'";
        parent::simple_query($query, FALSE);
    }
    
    /**
     * Procedure to select all records in a table according to their status
     * Procedimiento para seleccionar registros de una tabla según su estado
     * @param String $table_name
     * @param int or bool $state
     */
    public function select_by_state($table_name,$state)
    {
        $query = "SELECT * FROM  $table_name WHERE status=$state";
        parent::complete_query($query);
    }
    // ********************************************PICANDO CÓDIGO ***********************************************
    public function count_by_field($name_table,$field_name,$word)
    {
        $query = "SELECT COUNT(*) AS numb FROM $name_table WHERE $field_name='$word'";
        parent::simple_query($query, FALSE);
    }

        /**
     * Procedure to Update a Record Status
     * Procedimiento para Actualizar el estado de un registro
     * @param string $name_table
     * @param string $name_field
     * @param int $state
     */
    public function update_state($name_table,$name_fieldID,$fieldID,$state)
    {
        $query = "UPDATE $name_table SET status='$state' WHERE $name_fieldID='$fieldID'";
        parent::complete_query($query);
    }
    
    /**
     * procedure that gets an response
     * Procedimiento para obtener una respuesta
     * @return string, Object or Boolean
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
    protected function break_connection() {
        parent::break_connection();
    }
    
}

//        // Ensayo del código. Seleccionar contenido de una Tabla...
//       $objetc = new Common_SQL_Query;
//       $query = $objetc->select_by_ID('category', 'idcategory', 4);
//       $response = $objetc->get_response();
//       $objetc->break_connection();
//      
//     
//       // retorna false cuando no encuentra una tabla con el nombre solicitado
//       if($response == FALSE)
//       {
//           echo'<br>No Se encuentra una tabla con ese Nombre en la BD:... ';
//           echo '<br>respuesta:...';
//           var_dump($response);
//           echo '<br>Error:... ';
//           var_dump($objetc->get_error());
//      // Si consultamos de nuevo vemos que no se obtiene porque ya rompimos la conexión
//       $new_query = $objetc->select_all('category');
//       $new_response = $objetc->get_response();
//       echo '<br>nueva consulta ...<br> respuesta:... ';
//       var_dump($new_response);
//       echo '<br>Error:... ';
//       var_dump($objetc->get_error());
//       }
//       // en caso contrario Retorna el objeto completo
//       else
//       {
//           echo'<br>';
//           var_dump($response);
//       // Si consultamos de nuevo vemos que no se obtiene porque ya rompimos la conexión
//       $new_query = $objetc->select_all('category');
//       $new_response = $objetc->get_response();
//       echo '<br>nueva consulta ...<br> respuesta:... ';
//       var_dump($new_response);
//       echo '<br>Error:... ';
//       var_dump($objetc->get_error());
//       }
 
