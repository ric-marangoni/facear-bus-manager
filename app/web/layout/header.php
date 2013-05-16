<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A complete admin panel theme">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="author" content="Ricardo Marangoni da Mota - MRI Smart Systems">
        <title>Hípica Respite Management</title>
        
        <link rel="stylesheet" href="<?php echo CSSPATH ?>bootstrap.css"/>
        <link rel="stylesheet" href="<?php echo CSSPATH ?>bootstrap-responsive.css"/>
        <link rel="stylesheet" href="<?php echo CSSPATH ?>style.css"/>
        <link rel="stylesheet" href="<?php echo CSSPATH ?>plugins.css">
        
        <style type="text/css" media="print">
            @page land {
                size: landscape;
                writing-mode: tb-rl;
            }
            
            #landscape {
                page: land;
            }
        </style>
        
        <script type="text/javascript" src="<?php echo JSPATH ?>jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo JSPATH ?>jquery-ui.js"></script>
        
        <script type="text/javascript" src="<?php echo JSPATH ?>highcharts.js"></script>
        
        <script type="text/javascript" src="<?php echo JSPATH ?>jquery.PrintArea.js"></script>
		
        <!--[if IE]>
                <script type="text/javascript" src="<?php echo JSPATH ?>modernizr.custom.js"></script>
            <script type="text/javascript" src="<?php echo JSPATH ?>excanvas.js"></script>
        <![endif]-->
        <!--[if IE 8]>
                <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
            <link href="css/ie8.css" rel="stylesheet">
        <![endif]-->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--[if gte IE 9]>
                <style type="text/css">.gradient ul li{filter:none}</style>
        <![endif]-->
    </head>
    <body>
        <div class="header_wrapper">
            <div class="container-fluid">
                <div class="row-fluid">
                    <ul class="user_nav">
                        <li><span>&nbsp;</span></li>                       	
                        <!--<li>
                            <a href="#" title="Messages" data-toggle="dropdown" rel="tooltip" class="tips icon_mail menuDrop">
                                <span class="badge badge-info">3</span>
                            </a>
                            <ul class="dropdown-menu pull-right gradient user_dropdown">
                                <li class="list new">
                                    <div class="list_title">
                                        <div class="message"> 
                                            From: <span>40m ago by <a href="#">Benjamiin</a></span>
                                            <a href="#" class="subject">Getting Started on Zend Framework</a>
                                            <p>Vitae dicta sunt explicabo. Nemo enim dicta ut et.</p>
                                        </div>
                                    </div>
                                    <div class="list_action">
                                        <div class="btn-toolbar">
                                            <div class="btn-group">
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_027_search.png" class="i_action_view" alt="View"/>
                                                </button>
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_016_bin.png" class="i_action_delete" alt="Delete"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list new">
                                    <div class="list_title">
                                        <div class="message"> 
                                            From: <span>2 hours ago by <a href="#">Tim</a></span>
                                            <a href="#" class="subject">Thank you for using bolt.</a>
                                            <p>Hi,Eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                    <div class="list_action">
                                        <div class="btn-toolbar">
                                            <div class="btn-group">
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_027_search.png" class="i_action_view" alt="View"/>
                                                </button>
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_016_bin.png" class="i_action_delete" alt="Delete"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list">
                                    <div class="list_title">
                                        <div class="message"> 
                                            From: <span>40m ago <a href="#">Katherine Kate</a></span>
                                            <p>Lorem ipsum dolor sit amet...</p>
                                        </div>
                                    </div>
                                    <div class="list_action">
                                        <div class="btn-toolbar">
                                            <div class="btn-group">
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_027_search.png" class="i_action_view" alt="View"/>
                                                </button>
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_016_bin.png" class="i_action_delete" alt="Delete"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list list_hidden">
                                    <div class="list_title">
                                        <div class="message"> 
                                            From: <span>Yesterday <a href="#">Tim</a></span>
                                            <a href="" class="subject">Events for the next month</a>
                                            <p>Hi,Eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                    <div class="list_action">
                                        <div class="btn-toolbar">
                                            <div class="btn-group">
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_027_search.png" class="i_action_view" alt="View"/>
                                                </button>
                                                <button class="btn btn-mini">
                                                    <img src="img/icons/gray/glyphicons_016_bin.png" class="i_action_delete" alt="Delete"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list list_all">
                                    <div class="list_expand">
                                        <a href="#">Show all old messages</a>
                                    </div>
                                </li>
                            </ul>
                        </li>-->                       
                        <li>
                            <a href="index.html" title="Logout" rel="tooltip" class="tips icon_logout"></a>
                        </li>
                        <li>
                            <span>&nbsp;</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contentainer_wrapper">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="wrapper">
                            <div class="sidebar_navigation gradient">
                                <ul>
                                    <li class="tip-right <?php echo MODULE == 'Index' ? 'active' : '' ?>" title="Calendário">
                                        <a href="<?php echo BASEURL ?>" class="i_calendars">
                                            <span class="tab_label">Calendário</span>
                                            <span class="tab_info">Informações Gerais</span>
                                        </a>
                                    </li>
                                    <li class="tip-right <?php echo MODULE == 'Folga' ? 'active' : '' ?>" title="Cadastro de Folgas">
                                        <a href="<?php echo BASEURL ?>folga/incluir" class="i_forms">
                                            <span class="tab_label">Folgas</span>
                                            <span class="tab_info">Controle de Folgas</span>
                                        </a>
                                    </li>
                                    <li class="tip-right <?php echo MODULE == 'Grafico' ? 'active' : '' ?>" title="Dados Visuais">
                                        <a href="<?php echo BASEURL ?>grafico/show" class="i_charts">
                                            <span class="tab_label">Gráficos</span>
                                            <span class="tab_info">Dados Visuais</span>
                                        </a>
                                    </li>
                                    <li class="tip-right <?php echo MODULE == 'Funcionario' ? 'active' : '' ?>" title="Funcionários">
                                        <a href="<?php echo BASEURL ?>funcionario/listar" class="i_users">
                                            <span class="tab_label">Funcionários</span>
                                            <span class="tab_info">Cadastro de Funcionários</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="content_wrapper">
                                <div class="contents">