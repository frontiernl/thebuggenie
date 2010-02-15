<?php

	/**
	 * Issue relations table
	 *
	 * @author Daniel Andre Eikeland <zegenie@zegeniestudios.net>
	 * @version 2.0
	 * @license http://www.opensource.org/licenses/mozilla1.1.php Mozilla Public License 1.1 (MPL 1.1)
	 * @package thebuggenie
	 * @subpackage tables
	 */

	/**
	 * Issue relations table
	 *
	 * @package thebuggenie
	 * @subpackage tables
	 */
	class TBGIssueRelationsTable extends B2DBTable 
	{

		const B2DBNAME = 'issuerelations';
		const ID = 'issuerelations.id';
		const SCOPE = 'issuerelations.scope';
		const PARENT_ID = 'issuerelations.parent_id';
		const CHILD_ID = 'issuerelations.child_id';
		const MUSTFIX = 'issuerelations.mustfix';

		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addBoolean(self::MUSTFIX);
			parent::_addForeignKeyColumn(self::SCOPE, B2DB::getTable('TBGScopesTable'), TBGScopesTable::ID);
			parent::_addForeignKeyColumn(self::PARENT_ID, B2DB::getTable('TBGIssuesTable'), TBGIssuesTable::ID);
			parent::_addForeignKeyColumn(self::CHILD_ID, B2DB::getTable('TBGIssuesTable'), TBGIssuesTable::ID);
		}
		
		public function getRelatedIssues($issue_id)
		{
			$crit = $this->getCriteria();
			$ctn = $crit->returnCriterion(self::PARENT_ID, $issue_id);
			$ctn->addOr(self::CHILD_ID, $issue_id);
			$crit->addWhere($ctn);
			$crit->addWhere(TBGIssuesTable::DELETED, 0);
			$res = $this->doSelect($crit);
			return $res;
		}
		
		public function getIssueRelation($this_issue_id, $related_issue_id)
		{
			$crit = $this->getCriteria();
			$ctn = $crit->returnCriterion(self::PARENT_ID, $this_issue_id);
			$ctn->addOr(self::CHILD_ID, $this_issue_id);
			$ctn->addWhere($ctn);
			$ctn = $crit->returnCriterion(self::PARENT_ID, $related_issue_id);
			$ctn->addOr(self::CHILD_ID, $related_issue_id);
			$ctn->addWhere($ctn);
			$crit->addWhere(TBGIssuesTable::DELETED, 0);
			$res = $this->doSelectOne($crit);
			return $res;
		}
		
		public function addParentIssue($issue_id, $parent_id)
		{
			$crit = $this->getCriteria();
			$crit->addInsert(self::CHILD_ID, $issue_id);
			$crit->addInsert(self::PARENT_ID, $parent_id);
			$crit->addInsert(self::SCOPE, TBGContext::getScope()->getID());
			$res = $this->doInsert($crit);
			return $res;
		}
		
		public function addChildIssue($issue_id, $child_id)
		{
			$crit = $this->getCriteria();
			$crit->addInsert(self::PARENT_ID, $issue_id);
			$crit->addInsert(self::CHILD_ID, $child_id);
			$crit->addInsert(self::SCOPE, TBGContext::getScope()->getID());
			$res = $this->doInsert($crit);
			return $res;
		}
		
	}