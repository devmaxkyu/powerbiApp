<?php                                
    if ( ! session_id() ) {
        session_start();
    }
    $user = wp_get_current_user();
?>

<body class="sidebar_menu top_nav_fixed  pace-done">
    <div class="pace  pace-inactive">
        <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <!-- BEGIN PAGE-LOADER -->

    <!-- END PAGE-LOADER -->

    <!--Begin Sidebar-->
    <div class="sidebar" data-color="black"
        data-image="https://via.placeholder.com/1080x1920.png?text=http://perfectin.co/">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 635px;">
            <div class="sidebar-wrapper" style="overflow: hidden; width: auto; height: 635px;">
                <!--Begins Logo start-->

                <!--End Logo start-->

                <!--Begins User Section-->
                <div class="user">
                    <div class="photo">
                        <img alt="" src="https://via.placeholder.com/128x128.png?text=http://perfectin.co/">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#taxi_user_nav" class="collapsed">
                            <span class="ttu"><?php echo $user->display_name; ?>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="collapse m-t-10" id="taxi_user_nav">
                            <ul class="nav">
                                <li>
                                    <a class="profile-dropdown" href="javascript:void(0)">
                                        <span class="sidebar-mini m-t-5"><i class="icon-user"></i></span>
                                        <span class="sidebar-normal">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="profile-dropdown" href="javascript:void(0)">
                                        <span class="sidebar-mini m-t-5"><i class="icon-settings"></i></span>
                                        <span class="sidebar-normal">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="profile-dropdown" href="<?php echo wp_logout_url(); ?>">
                                        <span class="sidebar-mini m-t-5"><i class="icon-logout"></i></span>
                                        <span class="sidebar-normal">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--End User Section-->

                <ul class="nav nav-mobile-menu"></ul>
            </div>
            <div class="slimScrollBar"
                style="background: rgb(51, 51, 51); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 635px;">
            </div>
            <div class="slimScrollRail"
                style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
            </div>
        </div>
        <div class="sidebar-background"
            style="background-image: url(https://via.placeholder.com/1080x1920.png?text=http://perfectin.co/) "></div>
    </div>
    <!--End Sidebar-->

    <!-- BEGIN HEADER -->
    <div id="header">

        <!-- BEGIN TOP NAV ABR -->
        <div class="navbar navbar-default navbar-fixed-top bordered">
            <div class="navbar-header">
                <ul class="nav navbar-nav m-l-0 pull-left">
                    <li id="minimizeSidebar" class="navbar-toggler">
                        <a href="javascript:void(0)" class="d-inline-block">
                            <i class="icons icon-menu f-s-18 f-w-600 v-a-m m-r-10 hidden-xs">
                            </i>
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/logo.png" alt="perfectin" class="w-115">
                        </a>
                    </li>
                    <li data-toggle="tooltip" data-placement="bottom" data-trigger="hover"
                        class="hidden-xs hidden-sm hidden-md" title="Enter Peek Hours">
                        <div class="input-group input-group-sm width-300 m-t-8 m-l-25">
                            <span class="input-group-addon btn bg-dark">Peek Hours</span>
                            <input type="text" class="form-control" placeholder="Peek Hours" value="10:10 - 02:54"
                                autocomplete="off">
                            <span class="input-group-addon btn bg-dark">Save</span>
                        </div>
                    </li>
                </ul>

                <ul class="nav navbar-nav pull-right visible-xs-block">

                    <li>
                        <a data-toggle="collapse" data-target="#mobile_nav">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>

                    <li id="minimizeSidebar1" class="navbar-toggler">
                        <a class="text-center">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-collapse collapse" id="mobile_nav">
                <div class="navbar-right">
                    <ul class="nav navbar-nav">




                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="visible-xs-inline-block position-right">Notification(s)</span>
                                <span class="pulse hidden-xs"></span>
                            </a>

                            <div class="dropdown-menu dropdown-content">
                                <div class="dropdown-content-heading">
                                    Notification(s)
                                    <ul class="icons-list">
                                        <li><a href="javascript:void(0)" class="f-s-10 m-t-5">View All</a></li>
                                    </ul>
                                </div>

                                <ul class="media-list dropdown-content-body w-in-20">
                                    <li class="media">
                                        <div class="media-left">
                                            <img src="https://via.placeholder.com/128x128.png?text=http://perfectin.co/"
                                                class="thumbnail" alt="perfectin">
                                        </div>

                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="f-w-500">New User Registered</span>
                                                <span class="media-annotation pull-right">2 mins ago</span>
                                            </a>
                                            <span class="text-muted f-s-12">Lorem Ipsum is simply dummy text of the
                                                printing and typesetting industry...</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img src="https://via.placeholder.com/128x128.png?text=http://perfectin.co/"
                                                class="thumbnail" alt="perfectin">
                                        </div>

                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="f-w-500">Andrew shared a memory</span>
                                                <span class="media-annotation pull-right">1 hour ago</span>
                                            </a>
                                            <span class="text-muted f-s-12">Lorem Ipsum is simply dummy text of the
                                                printing and typesetting industry...</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/pf_logo.png" class="thumbnail" alt="perfectin">
                                        </div>

                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="f-w-500">Perfectin has 1 new view</span>
                                                <span class="media-annotation pull-right">Yesterday</span>
                                            </a>
                                            <span class="text-muted f-s-12">Lorem Ipsum is simply dummy text of the
                                                printing and typesetting industry...</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/svg/server.svg" class="thumbnail p-7"
                                                alt="perfectin">
                                        </div>

                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="f-w-500">Server Error Reports</span>
                                                <span class="media-annotation pull-right">2 days ago</span>
                                            </a>
                                            <span class="text-muted f-s-12">Lorem Ipsum is simply dummy text of the
                                                printing and typesetting industry...</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown dropdown-user">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://via.placeholder.com/128x128.png?text=http://perfectin.co/"
                                    alt="perfectin">
                                <span><?php echo $user->user_login; ?></span>
                                <i class="caret"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-header navigations">Navigation</li>
                                <li class="navigations">
                                    <a href="javascript:void(0)">
                                        <span class="badge badge-primary pull-right">4</span>
                                        <i class="fa fa-comment"></i> Messages
                                    </a>
                                </li>
                                <li class="navigations">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-user"></i> My profile
                                    </a>
                                </li>
                                <li class="navigations">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-cogs"></i> Account settings
                                    </a>
                                </li>
                                <li class="divider navigations"></li>
                                <li class="navigations">
                                    <a href="<?php echo wp_logout_url(); ?>">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END TOP NAV ABR -->

    </div>
    <!-- END HEADER -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-container" id="page-container" style="min-height:350px">

        <!-- BEGIN MAIN CONTENT -->
        <div class="main_content">
            <!-- BEGIN WRAPPER -->
            <div class="content-wrapper">
                <div class="page-header page-header-default">
                    <div class="page-header-content">
                        <div class="page-title">
                            <h5><span class="f-w-700">Dashboard</span> - Dashboard v1</h5>

                            <div>
                                <?php
                                    if ( ! session_id() ) {
                                        session_start();
                                    }
                                    do_action('display_reports');
                                ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- END WRAPPER -->
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END PAGE CONTENT -->



    <!-- BEGIN FOOTER -->
    <!-- <div class="navbar navbar-default footer">
        <footer id="footer" class="footer footer-inverse">
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-7 col-sm-7">
                        <div class="text-xs-center text-sm-left">
                            <ul class="footer-menu">
                                <li>
                                    <a href="index.html" class="p-l-0" target="_blank">Home</a>
                                </li>
                                <li>
                                    <a href="http://perfectin.co/" target="_blank">Website</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" target="_blank">Portfolio</a>
                                </li>
                            </ul>

                            <div class="copyright">
                                <ul class="copy-links">
                                    <li>
                                        © 2019 <a href="http://perfectin.co/" target="_blank">Perfectin</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">Terms</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">License</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" target="_blank">Privacy policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-5 res-xs-m-t-12">
                        <div class="text-sm-right">
                            <ul class="social-media social-media--style">
                                <li>
                                    <a href="javascript:void(0)" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" target="_blank">
                                        <i class="fa fa-github"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div> -->
    <!-- END FOOTER -->

    <!-- CHAT START -->
    <div class="ember-view" id="ember3">
        <!---->
        <div id="ember4" class="ember-view">
            <div class="hotline-launcher    ">
                <div class="viewport h-chat-custom ">
                    <div id="ember5" class="help-text fadeIn dn ember-view">
                        <!---->
                    </div>
                    <div id="ember24" class="h-channel ember-view">
                        <div class="h-header">
                            <div class="title fadeIn">
                                <span class="ic-chat"><i class="icon icon-ic_chat_icon"></i></span>
                                <h1 class="list-title">Message Us</h1>
                                <p class="list-desc">Hi there! We'd love to help you out!</p>
                            </div>
                            <div class="d_hotline minimize" data-ember-action="" data-ember-action-25="25"><i
                                    class="icon icon-ic_close mild"></i></div>
                            <!---->
                        </div>
                        <div class="body faq-body no-articles">
                            <div class="h-categories ">
                                <ul>
                                    <li>
                                        <div id="ember27" class="channel animated fadeInLeft ember-view"><a
                                                href="/channels/11445" id="ember28" class="channel-link ember-view">
                                                <div class="h-category-item animated fadeInRight">
                                                    <div class="h-category-icon">
                                                        <img class="img-circle avatar-image"
                                                            src="https://fc-use1-00-pics-bkt-00.s3.amazonaws.com/44218aff1020d0300c4e798367509bc467dcdb87c6ce08064322f3964f8cc934/f_marketingpicFull/u_fac5d6094c080bd0440c37914b328ff362987a562c4ea6a9e9f63f735cb8162b/img_1538045186264.png">
                                                    </div>
                                                    <div class="h-category-detail ">
                                                        <h1 class="channel-name">
                                                            <!-- {{channel.name}} -->
                                                            Product Feedback
                                                        </h1>
                                                        <h2 class="welcome-text">
                                                            <div class="last-msg-preview">
                                                                <div id="ember29" class="ember-view">
                                                                    <div class="h-comment  ">
                                                                        <!---->
                                                                        <div id="ember30" class="ember-view">
                                                                            <div class="h-message-text"><img
                                                                                    class="emojiCe"
                                                                                    src="https://assetscdn-wchat.freshchat.com/static/assets/images/emojis/emoji-wave.png"
                                                                                    alt="👋">&nbsp;We're all ears for
                                                                                feedback. Your opinion matters to us and
                                                                                we'd love to hear your thoughts to make
                                                                                the product better.&nbsp;
                                                                            </div>
                                                                            <!---->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div class="h-conv-user">
                                                        <!---->
                                                    </div>
                                                </div>
                                            </a></div>
                                    </li>
                                    <li>
                                        <div id="ember33" class="channel animated fadeInLeft ember-view"><a
                                                href="/channels/11371" id="ember34" class="channel-link ember-view">
                                                <div class="h-category-item animated fadeInRight">
                                                    <div class="h-category-icon">
                                                        <img class="img-circle avatar-image"
                                                            src="https://fc-use1-00-pics-bkt-00.s3.amazonaws.com/44218aff1020d0300c4e798367509bc467dcdb87c6ce08064322f3964f8cc934/f_marketingpicFull/u_fac5d6094c080bd0440c37914b328ff362987a562c4ea6a9e9f63f735cb8162b/img_1538044842215.png">
                                                    </div>
                                                    <div class="h-category-detail ">
                                                        <h1 class="channel-name">
                                                            <!-- {{channel.name}} -->
                                                            Product demo
                                                        </h1>
                                                        <h2 class="welcome-text">
                                                            <div class="last-msg-preview">
                                                                <div id="ember35" class="ember-view">
                                                                    <div class="h-comment  ">
                                                                        <!---->
                                                                        <div id="ember36" class="ember-view">
                                                                            <div class="h-message-text"><img
                                                                                    class="emojiCe"
                                                                                    src="https://assetscdn-wchat.freshchat.com/static/assets/images/emojis/emoji-raised_hands.png"
                                                                                    alt="🙌">&nbsp;Let’s talk about your
                                                                                messaging needs. Ask us any product
                                                                                questions you have and also request for
                                                                                your personalized demo.
                                                                            </div>
                                                                            <!---->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div class="h-conv-user">
                                                        <!---->
                                                    </div>
                                                </div>
                                            </a></div>
                                    </li>
                                    <li>
                                        <div id="ember39" class="channel animated fadeInLeft ember-view"><a
                                                href="/channels/11446" id="ember40" class="channel-link ember-view">
                                                <div class="h-category-item animated fadeInRight">
                                                    <div class="h-category-icon">
                                                        <img class="img-circle avatar-image"
                                                            src="https://fc-use1-00-pics-bkt-00.s3.amazonaws.com/44218aff1020d0300c4e798367509bc467dcdb87c6ce08064322f3964f8cc934/f_marketingpicFull/u_fac5d6094c080bd0440c37914b328ff362987a562c4ea6a9e9f63f735cb8162b/img_1538045210779.png">
                                                    </div>
                                                    <div class="h-category-detail ">
                                                        <h1 class="channel-name">
                                                            <!-- {{channel.name}} -->
                                                            Pricing &amp; Billing
                                                        </h1>
                                                        <h2 class="welcome-text">
                                                            <div class="last-msg-preview">
                                                                <div id="ember41" class="ember-view">
                                                                    <div class="h-comment  ">
                                                                        <!---->
                                                                        <div id="ember42" class="ember-view">
                                                                            <div class="h-message-text">Reach out to us
                                                                                in case you have any questions on
                                                                                pricing and billing here.
                                                                            </div>
                                                                            <!---->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div class="h-conv-user">
                                                        <!---->
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div id="ember45" class="channel animated fadeInLeft ember-view"><a
                                                href="/channels/10350" id="ember46" class="channel-link ember-view">
                                                <div class="h-category-item animated fadeInRight">
                                                    <div class="h-category-icon">
                                                        <img class="img-circle avatar-image"
                                                            src="https://fc-use1-00-pics-bkt-00.s3.amazonaws.com/44218aff1020d0300c4e798367509bc467dcdb87c6ce08064322f3964f8cc934/f_marketingpicFull/u_fac5d6094c080bd0440c37914b328ff362987a562c4ea6a9e9f63f735cb8162b/img_1538045150942.png">
                                                    </div>
                                                    <div class="h-category-detail ">
                                                        <h1 class="channel-name">
                                                            <!-- {{channel.name}} -->
                                                            Support
                                                        </h1>
                                                        <h2 class="welcome-text">
                                                            <div class="last-msg-preview">
                                                                <div id="ember47" class="ember-view">
                                                                    <div class="h-comment  ">
                                                                        <!---->
                                                                        <div id="ember48" class="ember-view">
                                                                            <div class="h-message-text">Hello
                                                                                there!&nbsp;<img class="emojiCe"
                                                                                    src="https://assetscdn-wchat.freshchat.com/static/assets/images/emojis/emoji-raised_hands.png"
                                                                                    alt="🙌"> Need help? Reach out to us
                                                                                right here, and we'll get back to you as
                                                                                soon as we can!&nbsp;
                                                                            </div>
                                                                            <!---->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div class="h-conv-user">
                                                        <!---->
                                                    </div>
                                                </div>
                                            </a></div>
                                    </li>
                                </ul>
                                <div id="ember50" class="footer-note ember-view"> <span>⚡ by </span>
                                    <a href="https://www.freshworks.com/live-chat-software/freshchat/?utm_source=messenger&amp;utm_medium=referral&amp;utm_campaign=chat&amp;app_id=143475898119635&amp;app_name=Palani Velayudam"
                                        class="product" target="_blank" rel="nofollow">Freshchat</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="ember51" class="tabs dn ember-view">
                        <!---->
                    </div>
                </div>
            </div>

            <!---->
            <div class="d-hotline h-btn animated zoomIn">
                <div class="chat-content">
                    <i class="icon-ic_chat_icon"></i>
                </div>
                <div class=" ">

                </div>
            </div>

            <style type="text/css">
                html,
                body {
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Fira Sans', 'Droid Sans', 'Cantarell', 'Helvetica Neue', sans-serif !important;
                }

                .h-chat-custom .h-channel .h-header,
                .h-chat-custom .h-conv .h-header,
                .h-chat-custom .h-conv .h-chat .h-comment,
                .h-chat-custom .h-conv .h-chat .h-fc-cobrowse,
                .h-chat-custom .h-conv div.body div.message-container.odd span.chat-msg,
                .preview-bubble,
                .notification-container .btn-container .btn-left,
                .iframe-modal .h-modal-notes .modal-header,
                .h-reply-wrapper .h-reply-button .h-img-button {
                    background-color: #45A4EC !important;
                }

                .h-chat-custom .h-channel .h-header .icon,
                .h-chat-custom .h-conv .h-header .icon,
                .h-chat-custom .h-channel .h-header .conv-title,
                .h-chat-custom .h-conv .h-header .conv-title,
                .h-chat-custom .h-channel .h-header .ic-back,
                .h-chat-custom .h-conv .h-header .ic-back,
                .h-chat-custom .h-channel .h-header .title,
                .h-chat-custom .h-conv .h-header .title,
                .h-chat-custom .h-conv .h-chat .h-comment,
                .h-chat-custom .h-conv .h-chat .h-fc-cobrowse,
                .h-chat-custom .h-conv div.body div.message-container.odd span.chat-msg,
                .iframe-modal .h-modal-notes .modal-header .frame-title,
                .iframe-modal .h-modal-notes .modal-header .h-close i,
                .preview-bubble,
                .h-reply-wrapper .h-reply-button .h-img-button {
                    color: #FFFFFF !important;
                }

                .h-chat-custom .h-conv div.body div.message-container.odd span.arrow.right {
                    border-left-color: #45A4EC !important;
                }

                .h-chat-custom .h-conv .h-chat .h-fc-cobrowse .sc-visitor-footer a {
                    color: #FFFFFF !important;
                }

                .h-chat-custom .h-conv .h-chat .h-fc-cobrowse .sc-visitor-tailer-control .sc-accept-btn {
                    color: #45A4EC !important;
                    background-color: #FFFFFF !important;
                }


                .h-chat-custom .h-conv .h-chat .h-fc-cobrowse .sc-visitor-tailer-control .sc-deny-btn {
                    color: #FFFFFF !important;
                }

                .h-chat-custom div.h-conv div.body {
                    background-image: url("https://assetscdn-wchat.freshchat.com/static/assets/images/texture_background_4-0e1c37997493f0c2d9eadae0994532ca.png");
                    background-color: #f4f5f6;
                }

                .preview-wrapper .top-border {
                    border-top: 4px solid #45A4EC;
                }

                .reply-options .reply-option-button {
                    border: 1px solid #45A4EC;
                }

                .reply-options .reply-option-button:hover {
                    background-color: #45A4EC !important;
                    color: #FFFFFF;
                }

                .d-hotline {
                    background-color: #45A4EC !important;
                    color: #FFFFFF !important;
                    border-color: transparent #45A4EC transparent transparent;
                }

                .loader {
                    border-top: 1em solid rgba(#45A4EC, 0.4);
                    border-right: 1.05em solid #45A4EC;
                    border-bottom: 1.05em solid #45A4EC;
                    border-left: 1.05em solid #45A4EC;
                }

                .article-modal .modal-footer .h-message-us-btn {
                    background-color: #45A4EC !important;
                    color: #FFFFFF !important;
                }

                .article-content .modal-footer .h-message-us-btn {
                    background-color: #45A4EC !important;
                    color: #FFFFFF !important;
                }

                .tabs .tabs-inner:after {
                    background-color: #45A4EC !important;
                }

                .btn-csat-yes {
                    background-color: #45A4EC !important;
                    color: #FFFFFF !important;
                    border: 0.5px solid #45A4EC !important;
                }

                .submit-rating .submit.btn {
                    background-color: #45A4EC !important;
                    color: #FFFFFF !important;
                }

                .send-offline-reply .send-message {
                    background-color: #45A4EC !important;
                    color: #FFFFFF !important;
                }

                .h-comment.h-wrapped-article .articles-listview .article-showmore,
                .preview-container .h-reply-button .h-button-area button span {
                    color: #45A4EC !important;
                }

                .preview-container .h-reply-button .h-button-area button {
                    border-color: #45A4EC !important;
                }

                .h-header .jwt-error-message {
                    color: #44412e !important;
                    background-color: #ffac00 !important;
                }
                
            </style>

        </div>
    </div>
    <!-- CHAT END -->
    <!-- END MODAL LOGIN -->

<?php
    function load_scripts(){
        $html = '<script src="'.get_bloginfo('template_directory').'/assets/chat.js"></script>';
        $html.= '<script src="'.get_bloginfo('template_directory').'/b/app.js"></script>';

        echo $html;
    }

    add_action('load_page_scripts', 'load_scripts');
?>

