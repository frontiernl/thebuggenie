<?php

	class TBGCalendarTasksTable extends B2DBTable
	{
		const B2DBNAME = 'calendartasks';
		const ID = 'calendartasks.id';
		const SCOPE = 'calendartasks.scope';
		const CALENDAR = 'calendartasks.calendar';
		const TITLE = 'calendartasks.title';
		const STARTS = 'calendartasks.starts';
		const ENDS = 'calendartasks.ends';
		const LOCATION = 'calendartasks.location';
		const ITEMTYPE = 'calendartasks.itemtype';
		const DESCRIPTION = 'calendartasks.description';
		const STATUS = 'calendartasks.status';
					
		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addVarchar(self::TITLE, 200);
			parent::_addText(self::DESCRIPTION, false);
			parent::_addInteger(self::STARTS, 10);
			parent::_addInteger(self::ENDS, 10);
			parent::_addInteger(self::ITEMTYPE, 3);
			parent::_addInteger(self::STATUS, 3);
			parent::_addVarchar(self::LOCATION, 200, '');
			parent::_addForeignKeyColumn(self::SCOPE, B2DB::getTable('TBGScopesTable'), TBGScopesTable::ID);
			parent::_addForeignKeyColumn(self::CALENDAR, B2DB::getTable('TBGCalendarsTable'), TBGCalendarsTable::ID);
		}
	}

?>