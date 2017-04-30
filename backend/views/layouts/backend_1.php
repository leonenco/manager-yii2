<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Yii::$app->getHomeUrl(); ?>/favicon.ico" type="image/x-icon" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-content">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->getHomeUrl()?>"><img src="<?=Yii::$app->getHomeUrl()?>/favicon.ico" alt="SManager panel" class="img-responsive"/>SManager</a>
                <a class="navbar-button menu-expand hidden-sm hidden-xs" href="#" title="Menu toggle"><i class="fa fa-fw fa-angle-left"></i></a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="search-wrapper">
                    <form class="search  sidebar-search-bordered" action="#" method="POST">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </div>
            </div>
            <!-- Top Menu Items -->
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="row">
                    <ul class="nav navbar-right top-nav">
                        <li class="dropdown message">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu message-dropdown">
                                <li class="message-preview">
                                    <a href="#">
                                        <div class="media">
                                            <span class="pull-left">
                                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong>John Smith</strong>
                                                </h5>
                                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="message-preview">
                                    <a href="#">
                                        <div class="media">
                                            <span class="pull-left">
                                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong>John Smith</strong>
                                                </h5>
                                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="message-preview">
                                    <a href="#">
                                        <div class="media">
                                            <span class="pull-left">
                                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong>John Smith</strong>
                                                </h5>
                                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="message-footer">
                                    <a href="#">Read All New Messages</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown alerts">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu alert-dropdown">
                                <?php 
                                if(\Yii::$app->session->getAllFlashes()){
                                foreach (\Yii::$app->session->getAllFlashes() as $key => $message) {
                                     echo '<li>' 
                                        . '<div class="alert alert-success" role="alert">' 
                                        . $message 
                                        . '</li>';
                                    }
                                } else {
                                    echo '<li>'
                                    . 'There are no alerts'
                                    . '</li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-item-a"><i class="fa fa-user top-img"></i><span class="hidden-xs hidden-sm hidden-md"><?php echo Yii::$app->user->identity->username; ?></span></a>
                        </li>
                        <li>
                            <?php 
                                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'logout'])
                                                . '<i class="fa fa-fw fa-power-off top-img"></i>'
                                    . Html::submitButton(
                                        'Logout',
                                        ['class' => 'btn btn-link logout nav-item-a']
                                    )
                                    . Html::endForm();
                            ?>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <div id="page-wrapper">
            <div class="sidenav">
                    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                    <div class="collapse navbar-collapse collapse out" id="menu-content">
                        <ul class="nav navbar-nav side-nav open">      	
                            <li class="nav-item <?php if(Url::current() === '/manager/') echo 'active'; ?>">
                                <a href="/manager/" class="nav-item-a" title="Main">
                                    <i class="fa fa-fw fa-dashboard"></i> Manager Home
                                </a>
                            </li>
                            <?php if(\Yii::$app->user->identity->role ==='admin'): ?>
                                <li class="nav-item <?php if(Url::current() === '/manager/settings/users/index') echo 'active'; ?>">
                                    <a href="/manager/settings/users/index" class="nav-item-a" title="Manage Users">
                                        <i class="fa fa-fw fa-users"></i> Users (admin)
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(\Yii::$app->user->identity->role ==='admin'): ?>
                                <li class="nav-item <?php if(Url::current() === '/manager/company-type/index') echo 'active'; ?>">
                                    <a href="/manager/company-type/index" class="nav-item-a" title="Manage company types">
                                        <i class="fa fa-fw fa-users"></i> Company types
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(\Yii::$app->user->identity->role ==='admin' || \Yii::$app->user->identity->role ==='company' || \Yii::$app->user->identity->role ==='user'): ?>
                                <li class="nav-item <?php if(Url::current() === '/manager/proposals/default/index') echo 'active'; ?>">
                                    <a href="/manager/proposals/" class="nav-item-a" title="Proposals">
                                        <i class="fa fa-fw fa-book"></i> Proposals
                                    </a>
                                </li>

                                <li class="nav-item <?php if(Url::current() === '/manager/projects/index') echo 'active'; ?>">
                                    <a href="/manager/projects/index" class="nav-item-a" title="Projects">
                                        <i class="fa fa-fw fa-tasks"></i> Projects
                                    </a>
                                </li>
                                <li class="nav-item <?php if(Url::current() === '/manager/messages/index') echo 'active'; ?>">
                                    <a href="/manager/messages/" class="nav-item-a" title="Message Center">
                                        <i class="fa fa-fw fa-comments-o"></i> Messages
                                    </a>
                                </li>
                                <li class="nav-item <?php if(Url::current() === '/manager/reports/index') echo 'active'; ?>">
                                    <a href="/manager/reports/" class="nav-item-a" title="Generate Reports">
                                        <i class="fa fa-fw fa-line-chart"></i> Reports
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item <?php if(Url::current() === '/manager/notes/index') echo 'active'; ?>">
                                <a href="/manager/notes/" class="nav-item-a" title="Notes">
                                    <i class="fa fa-fw fa-commenting-o"></i> Notes
                                </a>
                            </li>
                            <?php if(\Yii::$app->user->identity->role ==='admin'|| \Yii::$app->user->identity->role ==='company'): ?>
                                <li class="nav-item <?php if(Url::current() === '/manager/partners/index') echo 'active'; ?>">
                                    <a href="/manager/partners/" class="nav-item-a" title="Manage users and subcontractors">
                                        <i class="fa fa-fw fa-user"></i> My Users
                                    </a>
                                </li>

                                <li data-toggle="collapse" data-target="#cont14" class="collapsed nav-item">
                                    <a class="nav-item-a parent" title="My account"><i class="fa fa-fw fa-sliders"></i>My account<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="sub-menu collapse" id="cont14">
                                            <li class="nav-item <?php if(Url::current() === '/manager/profile/index') echo 'active'; ?>">
                                                    <a href="/manager/profile/" class="nav-item-a" title="Profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                                                </li>
                                                <li class="nav-item <?php if(Url::current() === '/manager/email/index') echo 'active'; ?>">
                                                    <a href="/manager/email/" class="nav-item-a" title="eMail"><i class="fa fa-fw fa-envelope-o"></i> eMail</a>
                                                </li>
                                                <li class="nav-item <?php if(Url::current() === '/manager/settings/index') echo 'active'; ?>">
                                                    <a href="/manager/settings/" class="nav-item-a" title="Settings"><i class="fa fa-fw fa-gear"></i> Settings</a>
                                                </li>
                                        </ul>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            <div class="container-fluid">            	
                <div class="main-scroll">
                	<div class="row">
                            <div class="col-lg-12">
                                <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                            </div>
                	</div>
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                <?= Html::encode($this->title) ?>
                            </h1>
                        </div>
                    </div>
                    <!-- /.row -->
    
                    <div class="row">
                        <div id="message" class="col-lg-12">                        	
                            <?php
                                if(Yii::$app->getSession()->getAllFlashes()) {
                                   $this->registerJs("$('#system-messages').fadeIn().animate({opacity: 1.0}, 4000). fadeOut('slow');");
                                }
                             ?>
                             <div id="system-messages" style="opacity: 1; display: none">
                                <?= Alert::widget(); ?>
                             </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    
                    <div class="row">
                    	<div class="col-lg-8 left">
                    		<?= $content ?>
                    	</div>
                    	<div class="col-lg-4 right">
                    		<?= $this->render('side-panel')?>
                    	</div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                            
                    </div>
                </div>    
            </div>
            <!-- /.container-fluid -->
    
        </div>
        <section id="footer">
            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <hr>
                    </div>
                </div>
            </div>
        </section>
        <!-- /#page-wrapper -->
        <section id="menu-bottom" class="hidden-lg hidden-md hidden-sm">
            <div class="container">
                <div class="row">
                    <ul class="nav bot-nav-fixed">
                        <li class="dropdown message">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                            <ul class="dropdown-menu message-dropdown">
                                <li class="message-preview">
                                    <a href="#">
                                        <div class="media">
                                            <span class="pull-left">
                                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong>John Smith</strong>
                                                </h5>
                                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="message-preview">
                                    <a href="#">
                                        <div class="media">
                                            <span class="pull-left">
                                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong>John Smith</strong>
                                                </h5>
                                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="message-preview">
                                    <a href="#">
                                        <div class="media">
                                            <span class="pull-left">
                                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                                            </span>
                                            <div class="media-body">
                                                <h5 class="media-heading"><strong>John Smith</strong>
                                                </h5>
                                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="message-footer">
                                    <a href="#">Read All New Messages</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown alerts">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                            <ul class="dropdown-menu alert-dropdown">
                                <li>
                                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                                </li>
                                <li>
                                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                                </li>
                                <li>
                                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                                </li>
                                <li>
                                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                                </li>
                                <li>
                                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                                </li>
                                <li>
                                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">View All</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user top-img"></i><span class="hidden-xs">[[!+modx.user.id:userinfo=`fullname`]]</span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="[[+link]]" title="[[+pagetitle]]"><i class="fa fa-fw [[+link_attributes]] top-img"></i>[[+pagetitle]]</a>
                                </li>
                                <li>
                                    <a href="[[+link]]" title="[[+pagetitle]]"><i class="fa fa-fw [[+link_attributes]] top-img"></i>[[+pagetitle]]</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="[[~6? &service=logout]]"><i class="fa fa-fw fa-power-off top-img"></i>Log Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row"></div>
        </section>
    </div>
    <!-- /#wrapper -->
<!-- Modal Add new -->
<div class="modal fade" id="modal-dialog" tabindex="-1" role="dialog" aria-labelledby="modal-title">
    <div class="modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
            <div id="success"></div>
            <div id="error"></div>
            <form class="modalform">
                <input name="action" type="hidden" value="value" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">Loading...</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div id="modal-xcontent" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <!--Content-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-4 pull-right">
                        <div class="btn-group btn-group-justified" role="group" aria-label="modal-title">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button id="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
	</div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>