<?php


class recordModel extends Zend_Db_Table {
	protected $_name = 'note_record';
	protected $_primary = 'recordId';
	public function addRecord($record) {
		$db = $this->getAdapter ();
		
		$where = $db->quoteInto ( ' userId = ?', 1 );
		$where .= $db->quoteInto ( ' and recordIntro = ?', $record ['recordIntro'] );
		
		$orderBy = 'recordId';
		if (count ( $this->fetchAll ( $where, $orderBy )->toArray () ))
			return 0;
		return $this->insert ( $record );
	}
	public function getRecord($recordId = 0) {
		if ($recordId == 0) {
			$db = $this->getAdapter ();
			$where = $db->quoteInto ( ' userId = ?', 1 );
			$orderBy = 'recordId desc';
			
			return $this->fetchAll ( $where, $orderBy )->toArray();
		}
	}
}