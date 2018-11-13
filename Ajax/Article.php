<?php
/* 
           * * * * * * * * * * * * * * * * * * * * * * * * * *
         * * Copyleft(C)  2018 GNU General Public License V3 * * 
       * * *         Made with love in Colombia!!!           * * *
         * *         @Author:... ==>BEANSWALKER<==           * *
           * * * * * * * * * * * * * * * * * * * * * * * * * *
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
     * This program is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     * You should have received a copy of the GNU General Public License
     * along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
$data_form = $_POST;
$option = $data_form["option"];
if($option == 'select_all' || $option == 'by_id' || $option =='by_state' || $option=='update_state' || $option=='repeat' )
{
    //echo"select todas";
    require_once '../Models/Common_SQL_Query.php';
    
    /**
     * class inherit to Common_SQL_Query
     */    
    class AjaxCategory extends Common_SQL_Query
    {
        static private  $data_form;
        
        /**
         * Construct to activate Connection DB and set data
         * Cosntructor para activar la conexión BD y fijar datos
         * @param Array $data_form
         */
        public function __construct($data_form) 
        {
            parent::__construct();
            self::$data_form = $data_form;
              
            
        }
        
        /**
         * procedure related to the Common_SQL_Query class
         * Procedimiento relacionado con la Clase the Common_SQL_Query
         * procedure to manage form data acording to an option
         * procedimiento para gestionar datos del formulario de acuerdo a una opción
         */
        public function process()
        {
            $option = self::$data_form["option"];
            $word = self::$data_form["word"];
            $name_field = "idcategory";
            $search_field = self::$data_form["search_field"];
            $id_cat = self::$data_form["id_cat"];
            $actual_state = self::$data_form['actual_state'];
            //el siguiente dato $new_state debe ser numérico
            $new_state = self::$data_form['new_state'];
            switch ($option) 
                {
                    case 'select_all':                    
                        parent::select_all('category');
                    break;

                    case 'by_id':
                        $id_cat = parent::clean_string($id_cat);
                        parent::select_by_ID('category', $name_field, $id_cat);
                    break;
                    case 'repeat':
                            //$id_cat = parent::clean_string($id_cat);
                         parent::count_by_field('category', $search_field, $word);
                            //parent::select_by_ID('category', $name_field, $id_cat);
                    break;
                

                    case 'by_state':
                        parent::select_by_state('category', $actual_state);
                    break;

                    default:
                        parent::update_state('category', $name_field, $id_cat, $new_state);
                    break;
                }
               
        }
        
        /**
         * procedure related to the Common_SQL_Query class
         * procedimiento relacionado con la clase Common_SQL_Query
         * procedure that gets an response
         * Procedimiento para obtener una respuesta
         * @return array, Objetc or Boolean 
         */
        public function get_response() 
        {
            return parent::get_response();
        }
        
        /**
         * procedure related to the Common_SQL_Query class
         * procedimiento relacionado con la clase Common_SQL_Query
         * Procedure that gets an error
         * procedimiento para obtener un error
         * @return string
         */
        public function get_error() 
        {
            return parent::get_error();
        }
        
        /**
         * procedure related to the Common_SQL_Query class
         * procedimiento relacionado con la clase Common_SQL_Query
         * Procedure that requests to break the connection with the DBMS
         * Procedimiento que solicita romper la conexión con el SGBD
         */
        public function break_connection() {
            parent::break_connection();
        }
    
    }
    
    //Ejecutamos la soicitud del formulario
    $objAjaxCat = new AjaxCategory($data_form);
    $objAjaxCat->process();
    $response = $objAjaxCat->get_response();
    //Aquí estaba antes el Breack_connection
    
    if($response == FALSE || $response == NULL)
    {
        $response = $objAjaxCat->get_error();
    }
    
    if($option == 'by_id' || $option=='repeat')
    {
        //utilizamos JSon para codificar mediante clave-Valor un registro
        $response = json_encode($response);
    }
//    if($option=='repeat')
//    {
//        $response = count($response); //Contamos el número de registros devueltos
//    }
    elseif ($option == 'select_all' || $option == 'by_state')
      {
        $mysql_object = Array();
        /**
         * convert a object in to array
         */
        while ($data_row= $response->fetch_object())
            {
            if($data_row->status == '1')
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }
                $mysql_object[] = array
                        (
                            // con el siguiente código implemento una bifurcación IF:...
                            // "0"=>($status)?:
                            // De manera que lo correspondiente a true va a continuación del signo de pregunta ?
                            // y el código que va después de los dos puntos : es para cuando la condición no se cumple:...
                           "0"=>($status)?'<button class="btn btn-success fa" title="Editar '.$data_row->name. '" onclick="show_record_by_id('.$data_row->idcategory.')"> <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></button>'.
                            ' <button class="btn btn-success fa" title="Desactivar '.$data_row->name. '" onclick="enable_disable('.$data_row->idcategory.','.$status.')"> <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>':
                            '<button class="btn btn-success fa" title="Editar '.$data_row->name. '" onclick="show_record_by_id('.$data_row->idcategory.')"> <i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i></button>'.
                            ' <button class="btn btn-success fa" title="Activar '.$data_row->name. '" onclick="enable_disable('.$data_row->idcategory.','.$status.')"><i class="fa fa-hand-peace-o" aria-hidden="true"></i></button>',//$data_row->idcategory,
                           "1"=>$data_row->name,
                           "2"=>$data_row->description,
                           // de nuevo implemento la bifurcación o condicional para mostrar la respectiva imágen:...
                           "3"=>($status)?'<img src="../Public/img/enable.png" title="Activa" width="30" height="30" />':'<img src="../Public/img/disable.png" title="Inactiva" width="30" height="30" />'
                           
                        );
            }
        
        // Configuramos la información para el DataTable.
        $data_object =array
                    (
                        "sEcho"=>1,
                        "iTotalRecords"=> count($mysql_object), //número de registros obtenidos
                        "iTotalDisplayRecords"=> count($mysql_object),//número de registros a mostrar
                        "aaData"=>$mysql_object
                        
                    );
        
        $response = json_encode($data_object);
        
      }
//      else
//    {
//          // **************************************** Aqui alitossssssssssssssssss ************
//        if($option == 'repeat')
//        {
//           $response = "successful2"; 
//        }
//    
//    }
      
    $objAjaxCat->break_connection();
    //cho 'Respuesta final:... '.$response;
    //var_dump($response);
     echo $response; 
}
else
{
    //echo 'editar o insertar';
    require_once '../Models/Category.php';
    
    /**
     * class inherit to Category
     */
    class AjaxCategory extends Category
     {
        static private  $data_form;
        
        /**
         * procedure related to the Categoy class
         * procedimiento relacionado con la clase Category
         * Construct to activate Connection DB and set data
         * Cosntructor para activar la conexión BD y fijar datos
         * @param Array $data_form
         */
        public function __construct($data_form) 
        {
            parent::__construct();
            self::$data_form = $data_form;
              
            
        }
        
        /**
         * procedure related to the Categoy class
         * procedimiento relacionado con la Clase Category
         * procedure to manage form data acording to an option
         * procedimiento para gestionar datos del formulario de acuerdo a una opción
         */
        public function process()
        {
            
            //$option = self::$data_form["option"];
            $nm = self::$data_form["nm"];
            $dscrptn = self::$data_form["dscrptn"];
            $id = self::$data_form["id"]; //debe ser 0 o 1
            $id_ctgry = self::$data_form["id_ctgry"];
            IF($id_ctgry==="")
            {
                //echo"Nuevo reg ".$id_ctgry;
                 parent::new_category($nm, $dscrptn, $id);
            }
            ELSE
            {
                //echo 'update Reg '.$id_ctgry;
                parent::edit_category($id_ctgry, $nm, $dscrptn);
            }
            
//            switch ($option) 
//            {
//                case 'nw_ctgry':
//                    parent::new_category($nm, $dscrptn, $id); 
//                break;
//
//                default:
//                    parent::edit_category($id_ctgry, $nm, $dscrptn);                   
//                break;
//            }
        }
        
        /**
         * procedure related to the Category class
         * procedimiento relacionado con la clase Category
         * procedure that gets an response
         * Procedimiento para obtener una respuesta
         * @return array, Objetc or Boolean 
         */
        public function get_response() 
        {
            return parent::get_response();
        }
        
        /**
         * procedure related to the Category class
         * procedimiento relacionado con la clase Category
         * Procedure that gets an error
         * procedimiento para obtener un error
         * @return string
         */
        public function get_error() 
        {
            return parent::get_error();
        }
        
        /**
         * procedure related to the Category class
         * procedimiento relacionado con la clase Category
         * Procedure that requests to break the connection with the DBMS
         * Procedimiento que solicita romper la conexión con el SGBD
         */
        public function break_connection() {
            parent::break_connection();
        }
    
    
    
     }
     
     $objAjaxCat = new AjaxCategory($data_form);
     $objAjaxCat->process();
     $response = $objAjaxCat->get_response();
     
    
    if($response == FALSE || $response == NULL)
    {
        $response = "Error en ".$objAjaxCat->get_error();
    }
    else
    {
    $response = "successful";
    }
    $objAjaxCat->break_connection();
    //echo 'Respuesta final:... ';
    //var_dump($response);
    echo $response;
     
}

if(empty($data_form))
{
    echo"No hay datos";
}