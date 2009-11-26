<?php

	class B2tArticleCategories extends B2DBTable
	{
		const B2DBNAME = 'articlecategories';
		const ID = 'articlecategories.id';
		const ARTICLE_NAME = 'articlecategories.article_name';
		const ARTICLE_IS_CATEGORY = 'articlecategories.article_is_category';
		const CATEGORY_NAME = 'articlecategories.category_name';
		const SCOPE = 'articlecategories.scope';
		
		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addVarchar(self::ARTICLE_NAME, 300);
			parent::_addBoolean(self::ARTICLE_IS_CATEGORY);
			parent::_addVarchar(self::CATEGORY_NAME, 300);
			parent::_addForeignKeyColumn(self::SCOPE, B2DB::getTable('B2tScopes'), B2tScopes::ID);
		}

		public function deleteCategoriesByArticle($article_name)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::ARTICLE_NAME, $article_name);
			$crit->addWhere(self::SCOPE, BUGScontext::getScope()->getID());
			$res = $this->doDelete($crit);
		}

		public function addArticleCategory($article_name, $category_name, $is_category)
		{
			$crit = $this->getCriteria();
			$crit->addInsert(self::ARTICLE_NAME, $article_name);
			$crit->addInsert(self::ARTICLE_IS_CATEGORY, $is_category);
			$crit->addInsert(self::CATEGORY_NAME, $category_name);
			$crit->addInsert(self::SCOPE, BUGScontext::getScope()->getID());
			$res = $this->doInsert($crit);
		}

		public function getArticleCategories($article_name)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::ARTICLE_NAME, $article_name);
			$crit->addWhere(self::SCOPE, BUGScontext::getScope()->getID());
			$crit->addOrderBy(self::CATEGORY_NAME, B2DBCriteria::SORT_ASC);
			$res = $this->doSelect($crit);

			return $res;
		}

		public function getCategoryArticles($category_name)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::CATEGORY_NAME, $category_name);
			$crit->addWhere(self::ARTICLE_IS_CATEGORY, false);
			$crit->addWhere(self::SCOPE, BUGScontext::getScope()->getID());
			$crit->addOrderBy(self::ARTICLE_NAME, B2DBCriteria::SORT_ASC);
			$res = $this->doSelect($crit);

			return $res;
		}

		public function getSubCategories($category_name)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::CATEGORY_NAME, $category_name);
			$crit->addWhere(self::ARTICLE_IS_CATEGORY, true);
			$crit->addWhere(self::SCOPE, BUGScontext::getScope()->getID());
			$crit->addOrderBy(self::CATEGORY_NAME, B2DBCriteria::SORT_ASC);
			$res = $this->doSelect($crit);

			return $res;
		}


	}

?>