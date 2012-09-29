<?php
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Auth/Adapter/Dbtable.php';

/*
 * 
 * controllers use database by extends this class
 * */
class Database extends Zend_Controller_Action{
    
    
    public function init()
    {
        try{
        $path = constant('APPLICATION_PATH').'/configs/mysql.ini';
        $dbconfig = new Zend_Config_Ini( $path , 'mysql');
        $db  = Zend_Db::factory( $dbconfig->db);
        $db->query('set names utf8');
        Zend_Db_Table::setDefaultAdapter( $db);
        
        $authAdapter = new Zend_Auth_Adapter_DbTable( $db);
        Zend_Registry::set( 'authAdapter' , $authAdapter);
        }catch(Exception $e){
        	echo $e->getMessage();
        }
    }
}