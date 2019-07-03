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
class horariosSql {
    
    
        public static function validateIfExistsHorario()
    {
        $query = "SELECT * FROM asignar WHERE trabajos_id=?";
        return $query;
    }
    
    
    
    
}
