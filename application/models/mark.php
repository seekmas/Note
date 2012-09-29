<?php
require_once 'Zend/Db/Table.php';


/*
 * 
 * note_mark table model
 * */
class markModel extends Zend_Db_Table_Abstract{
    
    protected $_name = 'note_mark';
    protected $_primary = 'markId';
    
    
    public function getItem()
    {
       return $this->fetchAll()->toArray();
    }
}