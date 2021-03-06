<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title> Planning Life 2 - PL2.com</title>
        <meta name="description" content="" />
        <meta name="author" content="" />

        <!-- http://davidbcalhoun.com/2010/viewport-metatag -->
        <meta name="HandheldFriendly" content="True" />
        <meta name="MobileOptimized" content="320" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!--// OPTIONAL & CONDITIONAL CSS FILES //-->   
        <!-- date picker css -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/datepicker.css?v=1') ?>" />
        <!-- full calander css -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/fullcalendar.css?v=1') ?>" />
        <!-- data tables extended CSS -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/TableTools.css?v=1') ?>" />
        <!-- bootstrap wysimhtml5 editor -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/bootstrap-wysihtml5.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/wysiwyg-color.css') ?>" />
        <!-- custom/responsive growl messages -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/toastr.custom.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/toastr-responsive.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/jquery.jgrowl.css?v=1') ?>" />

        <!-- // DO NOT REMOVE OR CHANGE ORDER OF THE FOLLOWING // -->
        <!-- bootstrap default css (DO NOT REMOVE) -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/bootstrap.min.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/bootstrap-responsive.min.css?v=1') ?>" />
        <!-- font awsome and custom icons -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/font-awesome.min.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/cus-icons.css?v=1') ?>" />
        <!-- jarvis widget css -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/jarvis-widgets.css?v=1') ?>" />
        <!-- Data tables, normal tables and responsive tables css -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/DT_bootstrap.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/responsive-tables.css?v=1') ?>" />
        <!-- used where radio, select and form elements are used -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/uniform.default.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/select2.css?v=1') ?>" />
        <!-- main theme files -->
        <link rel="stylesheet" href="<?php echo base_url('application/css/theme.css?v=1') ?>" />
        <link rel="stylesheet" href="<?php echo base_url('application/css/theme-responsive.css?v=1') ?>" />

        <!-- // THEME CSS changed by javascript: the CSS link below will override the rules above // -->
        <!-- For more information, please see the documentation for "THEMES" -->
        <link rel="stylesheet" id="switch-theme-js" href="<?php echo base_url('application/css/themes/default.css?v=1') ?>" />   
        <!-- To switch to full width -->
        <link rel="stylesheet" id="switch-width" href="<?php echo base_url('application/css/full-width.css?v=1') ?>" />

        <!-- Webfonts -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Lato:300,400,700' type='text/css' />

        <!-- All javascripts are located at the bottom except for HTML5 Shim -->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js') ?>"></script>
                    <script src="<?php echo base_url('application/js/include/respond.min.js') ?>"></script>
            <![endif]-->

        <!-- For Modern Browsers -->
        <link rel="shortcut icon" href="<?php echo base_url('application/img/favicons/favicon.png') ?>" />
        <!-- For everything else -->
        <link rel="shortcut icon" href="<?php echo base_url('application/img/favicons/favicon.ico') ?>" />
        <!-- For retina screens -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('application/img/favicons/apple-touch-icon-retina.png') ?>" />
        <!-- For iPad 1-->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('application/img/favicons/apple-touch-icon-ipad.png') ?>" />
        <!-- For iPhone 3G, iPod Touch and Android -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('application/img/favicons/apple-touch-icon.png') ?>" />

        <!-- iOS web-app metas -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo base_url('application/img/splash/ipad-landscape.png') ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
        <link rel="apple-touch-startup-image" href="<?php echo base_url('application/img/splash/ipad-portrait.png') ?>" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />
        <link rel="apple-touch-startup-image" href="<?php echo base_url('application/img/splash/iphone.png') ?>" media="screen and (max-device-width: 320px)" />

        <!-- Placed at the end of the document so the pages load faster -->

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js') ?>"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('application/js/libs/jquery.min.js') ?>"><\/script>')</script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js') ?>"></script>
        <script>window.jQuery.ui || document.write('<script src="<?php echo base_url('application/js/libs/jquery.ui.min.js') ?>"><\/script>')</script>

        <!-- IMPORTANT: Jquery Touch Punch is always placed under Jquery UI -->
        <script src="<?php echo base_url('application/js/include/jquery.ui.touch-punch.min.js') ?>"></script>

        <!-- REQUIRED: Datatable components -->
        <script src="<?php echo base_url('application/js/include/jquery.accordion.min.js') ?>"></script>

        <!-- REQUIRED: Toastr & Jgrowl notifications  -->
        <script src="<?php echo base_url('application/js/include/toastr.min.js') ?>"></script>
        <script src="<?php echo base_url('application/js/include/jquery.jgrowl.min.js') ?>"></script>

        <!-- REQUIRED: Sleek scroll UI  -->
        <script src="<?php echo base_url('application/js/include/slimScroll.min.js') ?>"></script>

        <!-- REQUIRED: Datatable components -->
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/jquery.dataTables.min.js') ?>"></script> -->
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/DT_bootstrap.min.js') ?>"></script> -->

        <script type="text/javascript">
            var ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));	
            if(!ismobile){
	    	
                /** ONLY EXECUTE THESE CODES IF MOBILE DETECTION IS FALSE **/
	    	
                /* REQUIRED: Datatable PDF/Excel output componant */
	    	
                /*-- document.write('<script src="<?php echo base_url('application/js/include/ZeroClipboard.min.js') ?>"><\/script>'); --*/
                /*-- document.write('<script src="<?php echo base_url('application/js/include/TableTools.min.js') ?>"><\/script>'); --*/
                /*-- document.write('<script src="<?php echo base_url('application/js/include/jquery.uniform.min.js') ?>"><\/script>'); --*/
                /*-- document.write('<script src="<?php echo base_url('application/js/include/select2.min.js') ?>"><\/script>'); --*/
                document.write('<script src="<?php echo base_url('application/js/include/jquery.excanvas.min.js') ?>"><\/script>');
                document.write('<script src="<?php echo base_url('application/js/include/jquery.placeholder.min.js') ?>"><\/script>');
	    	
                /** DEMO SCRIPTS **/
                $(function() {
                    /* show tooltips */
                    $.jGrowl("I am the <strong>smartest Admin Template</strong> on <strong>wrapbootstrap.com</strong>. Don't forget to check out all my pages.", { 
                        header: 'Welcome, I am Jarvis!', 
                        sticky: false,
                        life: 5000,
                        speed: 500,
                        theme: 'with-icon',
                        position: 'top-right', //this is default position
                        easing: 'easeOutBack',
                        animateOpen: { 
                            height: "show"
                        },
                        animateClose: { 
                            opacity: 'hide' 
                        }
                    });	
                });
                /** end DEMO SCRIPTS **/
	        
            }else{
	    	
                /** ONLY EXECUTE THESE CODES IF MOBILE DETECTION IS TRUE **/
	    	
                document.write('<script src="<?php echo base_url('application/js/include/selectnav.min.js') ?>"><\/script>');
                document.write('<script src="<?php echo base_url('application/js/include/responsive-tables.min.js') ?>"><\/script>');
            }
        </script>

        <!-- REQUIRED: iButton -->
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/jquery.ibutton.min.js') ?>"></script> -->

        <!-- REQUIRED: Justgage animated charts -->
    <!-- DISABLED <script src="<?php echo base_url('application/js/include/justgage.min.js') ?>"></script> -->
    <!-- DISABLED <script src="<?php echo base_url('application/js/include/raphael.2.1.0.min.js') ?>"></script> -->

        <!-- REQUIRED: Animated pie chart -->
        <script src="<?php echo base_url('application/js/include/jquery.easy-pie-chart.min.js') ?>"></script>

        <!-- REQUIRED: Functional Widgets -->
        <script src="<?php echo base_url('application/js/include/jarvis.widget.min.js') ?>"></script>
        <script src="<?php echo base_url('application/js/include/mobiledevices.min.js') ?>"></script>
        <!-- DISABLED (only needed for IE7 <script src="<?php echo base_url('application/js/include/json2.js') ?>"></script> -->

        <!-- REQUIRED: Full Calendar -->
        <script src="<?php echo base_url('application/js/include/jquery.fullcalendar.min.js') ?>"></script>		

        <!-- REQUIRED: Flot Chart Engine -->
        <script src="<?php echo base_url('application/js/include/jquery.flot.cust.min.js') ?>"></script>			
        <script src="<?php echo base_url('application/js/include/jquery.flot.resize.min.js') ?>"></script>		
        <script src="<?php echo base_url('application/js/include/jquery.flot.tooltip.min.js') ?>"></script>		
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/jquery.flot.orderBar.min.js') ?>"></script> -->	
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/jquery.flot.fillbetween.min.js') ?>"></script> -->	
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/jquery.flot.pie.min.js') ?>"></script> --> 	 

        <!-- REQUIRED: Sparkline Charts -->
        <script src="<?php echo base_url('application/js/include/jquery.sparkline.min.js') ?>"></script>

        <!-- REQUIRED: Infinite Sliding Menu (used with inbox page) -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/jquery.inbox.slashc.sliding-menu.js') ?>"></script> -->

        <!-- REQUIRED: Form validation plugin -->
        <script src="<?php echo base_url('application/js/include/jquery.validate.min.js') ?>"></script>

        <!-- REQUIRED: Progress bar animation -->
        <script src="<?php echo base_url('application/js/include/bootstrap-progressbar.min.js') ?>"></script>

        <!-- REQUIRED: wysihtml5 editor -->
        <script src="<?php echo base_url('application/js/include/wysihtml5-0.3.0.min.js') ?>"></script>
        <script src="<?php echo base_url('application/js/include/bootstrap-wysihtml5.min.js') ?>"></script>

        <!-- REQUIRED: Masked Input -->
        <script src="<?php echo base_url('application/js/include/jquery.maskedinput.min.js') ?>"></script>

        <!-- REQUIRED: Bootstrap Date Picker -->
        <script src="<?php echo base_url('application/js/include/bootstrap-datepicker.min.js') ?>"></script>

        <!-- REQUIRED: Bootstrap Wizard -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/bootstrap.wizard.min.js') ?>"></script> -->

        <!-- REQUIRED: Bootstrap Color Picker -->
    <!-- DISABLED  <script src="<?php echo base_url('application/js/include/bootstrap-colorpicker.min.js') ?>"></script> -->


        <!-- REQUIRED: Bootstrap Time Picker -->
    <!-- DISABLED  <script src="<?php echo base_url('application/js/include/bootstrap-timepicker.min.js') ?>"></script> -->

        <!-- REQUIRED: Bootstrap Prompt -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/bootbox.min.js') ?>"></script> -->

        <!-- REQUIRED: Bootstrap engine -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/bootstrap.min.js') ?>"></script> -->
        <script src="<?php echo base_url('application/js/bootstrap.js') ?>"></script>       

        <!-- DO NOT REMOVE: Theme Config file -->
        <script src="<?php echo base_url('application/js/config.js') ?>"></script>

        <!-- d3 library placed at the bottom for better performance -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/d3.v3.min.js') ?>"></script> -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/adv_charts/d3-chart-1.js') ?>"></script> -->
        <!-- DISABLED  <script src="<?php echo base_url('application/js/include/adv_charts/d3-chart-2.js') ?>"></script> -->

        <!-- Google Geo Chart -->
        <!-- DISABLED <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script> -->
        <!-- DISABLED <script type='text/javascript' src='https://www.google.com/jsapi'></script>-->
        <!-- DISABLED <script src="<?php echo base_url('application/js/include/adv_charts/geochart.js') ?>"></script> -->

        <script src="<?php echo base_url('application/js/jquery.maskMoney.js') ?>"></script>
        <script src="<?php echo base_url('application/js/script.js') ?>"></script>       

        <!-- end scripts -->

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

    <body>
        <!-- .height-wrapper -->
        <div class="height-wrapper">

            <!-- header -->
            <header>
                <!-- tool bar -->
                <div id="header-toolbar" class="container-fluid">
                    <!-- .contained -->
                    <div class="contained">

                        <!-- theme name -->
                        <h1> <span class="hidden-phone">Planning Life 2 - </span> PL2.com </h1>
                        <!-- end theme name -->

                        <!-- span4 -->
                        <div class="pull-right">
                            <!-- demo theme switcher-->
                            <div id="theme-switcher" class="btn-toolbar">

                                <!-- search and log off button for phone devices -->
                                <div class="btn-group pull-right visible-phone">
                                    <a href="javascript:void(0)" class="btn btn-inverse btn-small"><i class="icon-search"></i></a>
                                    <a href="login.html" class="btn btn-inverse btn-small"><i class="icon-off"></i></a>
                                </div>
                                <!-- end buttons for phone device -->

                                <!-- dropdown mini-inbox-->
                                <div class="btn-group">
                                    <!-- new mail ticker -->
                                    <a href="javascript:void(0)" class="btn btn-small btn-inverse dropdown-toggle" data-toggle="dropdown">
                                        <span class="mail-sticker">3</span>
                                        <i class="cus-email"></i>
                                    </a>
                                    <!-- end new mail ticker -->

                                    <!-- email lists -->
                                    <div class="dropdown-menu toolbar pull-right">
                                        <h3>Inbox</h3>
                                        <ul id="mailbox-slimscroll-js" class="mailbox">
                                            <li>
                                                <a href="javascript:void(0)" class="unread">
                                                    <img src="img/email-important.png" alt="important mail" />
                                                    From: David Simpson
                                                    <i class="icon-paper-clip"></i>
                                                    <span>Dear Victoria, Congratulations! Your work has been uploaded to wrapbootstrap.com...</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="unread attachment">

                                                    <img src="img/email-unread.png" alt="important mail" />
                                                    Re:Last Year sales
                                                    <i class="icon-paper-clip"></i>
                                                    <span>Hey Vicky, find attached! Thx :-)</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="unread">
                                                    <img src="img/email-unread.png" alt="important mail" />
                                                    Company Party
                                                    <i class="icon-paper-clip"></i>
                                                    <span>Hi, You have been cordially invited to join new year after party.</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="read">
                                                    <img src="img/email-read.png" alt="important mail" />
                                                    RE: 2 Bugs found...
                                                    <i class="icon-paper-clip"></i>
                                                    <span>I have found two more bugs in this your beta version, maybe its not working...</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="read">
                                                    <img src="img/email-read.png" alt="important mail" />
                                                    2 Bugs found...
                                                    <i class="icon-paper-clip"></i>
                                                    <span>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales.</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="read">
                                                    <img src="img/email-read.png" alt="important mail" />
                                                    Welcome to Jarvis!
                                                    <i class="icon-paper-clip"></i>
                                                    <span>Feugiat a, tellus. Phasellus viverra nulla ut metus varius. Quisque rutrum. Aenean imperdiet... </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <a href="javascript:void(0);" id="go-to-inbox">Go to Inbox <i class="icon-double-angle-right"></i></a>
                                    </div>
                                    <!-- end email lists -->
                                </div>
                                <!-- end dropdown mini-inbox-->

                                <!-- Tasks -->
                                <div class="btn-group hidden-phone">
                                    <a href="javascript:void(0)" class="btn btn-inverse btn-small">My Tasks</a>
                                    <a href="javascript:void(0)" class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown"><span class="caret"></span></a>

                                    <div class="dropdown-menu toolbar pull-right">
                                        <h3>Showing All Tasks</h3>
                                        <ul class="progressbox">
                                            <li>
                                                <strong><i class="online pull-left"></i>Urgent Bug Fixes</strong><b class="pull-right">Complete</b>
                                                <div class="progress progress-success slim"><div class="bar" style="width: 100%;"></div></div>
                                            </li>
                                            <li>
                                                <strong>Added functionality</strong><b class="pull-right">70%</b>
                                                <div class="progress progress-info slim"><div class="bar" style="width: 70%;"></div></div>
                                            </li>
                                            <li>
                                                <strong>CAD Changes</strong><b class="pull-right">50%</b>
                                                <div class="progress progress-info slim"><div class="bar" style="width: 50%;"></div></div>
                                            </li>
                                            <li>
                                                <strong>Marketing Campaign Mocup</strong><b class="pull-right">22%</b>
                                                <div class="progress progress-danger slim"><div class="bar" style="width: 22%;"></div></div>
                                            </li>
                                            <li>
                                                <strong><i class="offline pull-left"></i>Proposal</strong><b class="pull-right">Pending</b>
                                                <div class="progress progress-info slim"><div class="bar" style="width: 0%;"></div></div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <!-- end Tasks -->

                                <!-- theme dropdown -->
                                <div class="btn-group hidden-phone">
                                    <a href="javascript:void(0)" class="btn btn-small btn-inverse" id="reset-widget"><i class="icon-refresh"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-small btn-inverse dropdown-toggle" data-toggle="dropdown">Themes <span class="caret"></span></a>
                                    <ul id="theme-links-js" class="dropdown-menu toolbar pull-right">
                                        <li>
                                            <a href="javascript:void(0)" data-rel="purple"><i class="icon-sign-blank purple-icon"></i>Royal Purple</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-rel="blue"><i class="icon-sign-blank navyblue-icon"></i>Navy Blue</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-rel="green"><i class="icon-sign-blank green-icon "></i>Emerald</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-rel="darkred"><i class="icon-sign-blank red-icon "></i>Dark Rose</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-rel="default"><i class="icon-sign-blank grey-icon"></i>Default</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end theme dropdown-->

                            </div>
                            <!-- end demo theme switcher-->
                        </div>
                        <!-- end span4 -->
                    </div>
                    <!-- end .contained -->
                </div>
                <!-- end tool bar -->

            </header>
            <!-- end header -->

            <div id="main" role="main" class="container-fluid">
                <div class="contained">

                    <?php echo $contents ?>

                </div>

            </div><!--end fluid-container-->
            <div class="push"></div>
        </div>
        <!-- end .height wrapper -->

        <!-- footer -->

        <!-- if you like you can insert your footer here -->

        <!-- end footer -->

        <!--================================================== -->

    </body>
</html>