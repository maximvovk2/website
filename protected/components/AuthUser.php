<?php

class AuthUser extends CWebUser
{
    private $_model = null;

    const ROLE_ADMIN = 1;
    const ROLE_SALES = 2;
    const ROLE_RECRUITER = 3;
    public $loginUrl = array('/admin/default/login');
    public static $denies = array(
        'UsersController' => array(self::ROLE_ADMIN),
        'TechController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'TagsController' => array(self::ROLE_ADMIN),
        'ProjectsController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'VacanciesController' => array(self::ROLE_SALES, self::ROLE_RECRUITER, self::ROLE_ADMIN),
        'DocumentsController' => array(self::ROLE_ADMIN),
        //'PartnersController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'SlidesController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'ManagementController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'StaticpagesController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'ContactdataController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'ContactusController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'SuccessstoriesController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'MenuController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
        'ConditionsController' => array(self::ROLE_SALES, self::ROLE_ADMIN),
    );
    private $_user;
    public function getModel(){
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = Users::model()->findByPk($this->id);
        }
        return $this->_model;
    }

}
