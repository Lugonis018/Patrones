<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of horariosSql
 *
 * @author rosa
 */
class documentosSql {
    
    
        public static function validateIfExistsHorario()
    {
        $query = "SELECT * FROM tbl_documentos WHERE trabajos_id=?";
        return $query;
    }
    
    
    
    
}
