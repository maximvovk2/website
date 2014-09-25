<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="">
	<meta name="viewport" content="width=1020" />
	<meta name="MobileOptimized" content="1020" />
	<title>CHI Software</title>
	<link media="all" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colorbox.css" />
	<link media="all" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/all.css" />
    <link media="all" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jcf.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/jcf.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/jcf.checkbox.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/jquery-1.9.0.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/modernizr-2.6.2.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/waypoints.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.nicescroll.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.colorbox.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.main.js"></script>
</head>
<body>
	<div id="wrapper">
		<div class="content_wrapper">
            <header id="header" class="bg_main">
                <div class="header-frame">
                    <div class="header_holder group">
                        <strong class="logo"><a href="/">CHI software</a></strong>
                        <!--                    --><?php //$this->widget('Menu'); ?>
                        <nav id="nav">
                            <?php $this->renderPartial('application.views.layouts._menu', array('rootId' => 0)); ?>
                        </nav>
                    </div>
                </div>
                <div class="main_header_holder">
                    <h1><?php echo $this->pageTitle; ?></h1>
                </div>
            </header>
        </div>
            <?php echo $content; ?>
        <footer id="footer">
                <div class="footer-holder">
                    <div class="footer-frame">
                        <div class="four-columns">
                            <div class="col">
                                <ul>
                                    <li>Chi Software</li>
                                    <li>2003-<?php echo date('Y'); ?> &copy;</li>
                                </ul>
                            </div>
                            <?php $this->renderPartial('application.views.layouts._footer', array('rootId' => 0)); ?>
                        </div>
                    </div>
                </div>
            </footer>
	</div>
	<div id="bg"><img src="images/backgrounds/bg-body1.jpg" alt="" /></div>
</body>
</html>