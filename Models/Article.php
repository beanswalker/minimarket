<?php
/*
 * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * *Copyleft(C)  2018 GNU General Public License V3 * * 
 * *Made with love in Colombia by:..>>BeansWalker<< * * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of Article
 *
 * @author beanswalker
 */
class Article extends Connection_DB {
    /**
     * launch the connection with the DBMS 
     * Lanzar la Conexión con el SGBD
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Procedure to Create a New Article
     * @param int $id_ctgry
     * @param string $cd
     * @param string $nm
     * @param int $stck
     * @param string $dscrptn
     * @param string $img
     * @param int or boolean $id
     */
    public function new_article($id_ctgry,$cd,$nm,$stck,$dscrptn,$img,$id)
    {
        $query = "INSERT INTO article (idcategory,code,name,stock,description,image) VALUES ('$id_ctgry','$cd','$nm','$stck','$dscrptn','$img')";
        if ($id == TRUE)
        {
            parent::simple_query($query, TRUE);
        }
       else
       {
            parent::complete_query($query);
       }
    }
    
    public function edit_article($id_artcl,$id_ctgry,$cd,$nm,$stck,$dscrptn,$img)
    {
        $query = "UPDATE article SET idcategory='$id_ctgry', code='$cd', name='$nm', stock='$stck', description='$dscrptn', image='$img' WHERE id_article='$id_artcl'";
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
    // PENDIENTE PARA SELECCIONAR LOS ARTICULOS **************************************************
    
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