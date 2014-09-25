<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Admin Home Page</title>
    <meta content="content-type: text/html; charset=utf-8" />
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
<?php $role = (isset(Yii::app()->user->model->role)) ? Yii::app()->user->model->role : 0; ?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="/admin">Admin Panel</a>
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>
                            <?php
                            if(isset(Yii::app()->user->model->username)){
                                echo Yii::app()->user->model->username;
                            }else{
                                $this->redirect('/admin/default/logout');
                            }
                            ?>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a tabindex="-1" href="/admin/default/logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div id="menu-top">
                <?php

                $this->widget('zii.widgets.CMenu',array(
                    'activeCssClass'=>'active',
                    'activateParents'=>true,
                    'items'=>array(
                        array
                        (
                            'label'=>'Menu',
//                            'url'=>array('#'),
                            'linkOptions'=>array('id'=>'menuCompany'),
                            'itemOptions'=>array('id'=>'itemCompany'),
                            'items'=>array(
                                array('label'=>'Menu', 'url'=>array('/admin/menu')),
                                array('label'=>'Categories', 'url'=>array('/admin/menuCategories')),
                            )
                        ),
                        array
                        (
                            'label'=>'Home',
//                            'url'=>array('#'),
                            'linkOptions'=>array('id'=>'menuCompany'),
                            'itemOptions'=>array('id'=>'itemCompany'),
                            'items'=>array(
                                array('label'=>'Conditions', 'url'=>array('/admin/conditions')),
                                array('label'=>'Testimonials', 'url'=>array('/admin/testmonials')),
                                array('label'=>'Clients', 'url'=>array('/admin/Clients')),
                                )
                        ),
                        array('label'=>'Static content', 'url'=>array('/admin/staticpages')),
                        array
                        (
                            'label'=>'Expertise',
//                            'url'=>array('#'),
                            'linkOptions'=>array('id'=>'menuCompany'),
                            'itemOptions'=>array('id'=>'itemCompany'),
                            'items'=>array(
                                array('label'=>'Projects', 'url'=>array('/admin/projects')),
                                array('label'=>'Technologies', 'url'=>array('/admin/tech')),
                                array('label'=>'Tags', 'url'=>array('/admin/tags')),
                            )
                        ),
                        array('label'=>'Success stories', 'url'=>array('/admin/successstories')),
//                        array('label'=>'Marketing Documents', 'url'=>array('/admin/documents')),
                        array
                        (
                            'label'=>'Marketing Documents',
                            'url'=>array('/admin/documents'),
                            'linkOptions'=>array('id'=>'menuCompany'),
                            'itemOptions'=>array('id'=>'itemCompany'),
                            'items'=>array(
                                array('label'=>'Titles', 'url'=>array('/admin/titles')),
                            )
                        ),
                        array('label'=>'Management', 'url'=>array('/admin/management')),
                        array('label'=>'Vacancies', 'url'=>array('/admin/vacancies')),
                        array
                        (
                            'label'=>'Contact Us',
//                            'url'=>array('#'),
                            'linkOptions'=>array('id'=>'menuCompany'),
                            'itemOptions'=>array('id'=>'itemCompany'),
                            'items'=>array(
                                array('label'=>'Contact data', 'url'=>array('/admin/contactdata')),
                                array('label'=>'Questions', 'url'=>array('/admin/contactus')),
                            )
                        ),
                        array('label'=>'Users', 'url'=>array('/admin/users')),

                    ),
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class'=>'nav',
                    ),
//                    'submenuHtmlOptions' => array(
//                        'class' => 'dropdown-menu',
//                    )
                ));
                ?>
                </div>
            </div>
        </div>
<!--                <ul class="nav">-->
<!--                    --><?php //if (in_array($role, AuthUser::$denies['MenuController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'menu') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu</a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li>-->
<!--                                    <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/menu">Menu</a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/menuCategories">Categories</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['TechController'])) : ?>
<!--                    <li --><?php //echo ($this->active == 'tech') ? 'class="active"' : ''; ?><!-->
<!--                        <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/tech">Technologies</a>-->
<!--                    </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['TagsController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'tags') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/tags">Tags</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['ProjectsController'])) : ?>
<!--                    <li --><?php //echo ($this->active == 'projects') ? 'class="active"' : ''; ?><!-->
<!--                        <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/projects">Projects</a>-->
<!--                    </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['ConditionsController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'conditions') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/conditions">Conditions</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['VacanciesController'])) : ?>
<!--                    <li --><?php //echo ($this->active == 'vacancies') ? 'class="active"' : ''; ?><!-->
<!--                        <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/vacancies">Vacancies</a>-->
<!--                    </li>-->
<!--                    --><?php //endif; ?>
<!--<!--                    --><?php ////if (!in_array($role, AuthUser::$denies['PartnersController'])) : ?>
<!--<!--                        <li --><?php ////echo ($this->active == 'partners') ? 'class="active"' : ''; ?><!--<!-->
<!--<!--                            <a href="--><?php ////echo Yii::app()->request->baseUrl; ?><!--<!--/admin/partners">Partners</a>-->
<!--<!--                        </li>-->
<!--<!--                    --><?php ////endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['DocumentsController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'documents') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/documents">Documents</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!---->
<!--                    --><?php //if (in_array($role, AuthUser::$denies['ManagementController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'management') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/management">Management</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                     --><?php //if (in_array($role, AuthUser::$denies['StaticpagesController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'staticpages') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/staticpages">Static content</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['ContactdataController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'contactdata') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/contactdata">Contact data</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['ContactusController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'contactus') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/contactus">Questions</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                    --><?php //if (in_array($role, AuthUser::$denies['SuccessstoriesController'])) : ?>
<!--                        <li --><?php //echo ($this->active == 'successstories') ? 'class="active"' : ''; ?><!-->
<!--                            <a href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/admin/successstories">Success stories</a>-->
<!--                        </li>-->
<!--                    --><?php //endif; ?>
<!--                </ul>-->
            </div>
<!--            <!--/.nav-collapse -->
        </div>
    </div>
</div><br><br><br>
<div class="container-fluid">
    <div class="row-fluid">
        <?php echo $content; ?>

    </div>
    <hr>

</div>
<!--/.fluid-container-->
<footer>
    <p>&copy; Admin</p>
</footer>
</body>

</html>
