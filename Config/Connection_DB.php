<?php
require_once 'ConnectData.php';
/*
 * Made with love in Colombia by BeansWalker
 * 
 * Copyleft (C) 2017 BeansWalker
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
 * Class to connect DB
 *
 * @author BeansWalker
 */

class Connection_DB extends ConnectData
{
    //Los aributos privados estáticos solo serán accedidos desde dentro de la clase
    static private $connex;
    static private $responseSQL;
    static private $response_error;


    /**
     * Connect database using the constructor
     * Conectarse a la BD mediante el constructor
     */
    protected function __construct()
        {
        
            self::$connex = new mysqli(parent::server_system, parent::user_system, parent::user_pass, parent::db_system);
            mysqli_query(self::$connex, 'SET NAMES "'.parent::db_charset.'"');

            if(self::$connex->connect_error)
                        {
                        // CODIGO PENDIENTE PARA MEJORAR !!!!

                        echo "

                      <img src='../Files/error1.png' width='974' height='641' alt='error1'/>
                                  ";
                        die("fallo la conexión en:.. ". self::$connex->connect_error);
                        //exit();

                        }
        }
        
        
        /**
         * SQL procedure that returns a complete content
         * Procedimiento SQL que retorna un contenido Completo
         * @param string $code_sql
         * @return String
         */
        protected function complete_query($code_sql)
        {
            $query = self::$connex->query($code_sql); //mysqli_query(self::$connex, $code_sql);
            self::$responseSQL = $query;
        }
        
        /**
         * SQL procedure that returns a simple content or an ID
         * Procedimiento SQL que retorna un contenido simple o un ID
         * @param string $code_sql
         * @return string
         */
        
        /**
         *Procedure to capture a simple SQL content or the ID of the last record
         * Procedimiento para capturar un contenido SQL simple o el ID del último registro
         * @param string $code_sql
         * @param boolean $id
         */
        protected function simple_query($code_sql,$id)
        {
            $query = self::$connex->query($code_sql);
            
            if($query)
            {
                
                    if($id == TRUE)
                    {
                        $query = self::$connex->insert_id;
                    }
                    if($id == FALSE)
                    {
                        $query = $query->fetch_assoc();
                    }
//                    else
//                    {
//                        $query = $query->fetch_assoc();
//                        
//                    }
            }
            else
            {
                $query = FALSE;
            }
            
            self::$responseSQL = $query;
        }
        
        /**
         * procedure to escape special characters in a String
         * Procedimiento para escapar caracteres especiales en un string
         * @param  $strg
         * @return string
         */
        protected function clean_string($strg)
        {
            $escape_string = mysqli_real_escape_string(self::$connex, trim($strg));
            return htmlspecialchars($escape_string);
        }
        
        /**
         * procedure that returns SQL response as an object
         * Procedimiento que devuelve la respuesta de SQL Como un Objeto
         * @return string, Object or boolean
         */
        protected function get_response() 
        {  
            if(self::$responseSQL === FALSE)
            {
              self::$response_error = self::$connex->error;
                
            }
            return self::$responseSQL;
            
        }
        
        /**
         * Procedure that returns an SQL Error
         * Procedimiento que retorna un Error de SQL
         * @return string
         */
        protected function get_error()
        {
            return self::$response_error;
        }
        
        /**
         * Procedure or event to break the connection with the DBMS
         * Procedimiento-Evento para romper la conexión con el SGBD
         */
        protected function break_connection()
        {
            //Get the ID  of thread
            //Obtener el ID del Hilo de conexión :..
            $my_threadID = self::$connex->thread_id;
            
            //break the connection
            //rompemos la conexión:..
            self::$connex->kill($my_threadID);
        }

}