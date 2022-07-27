<?php
//引入class
include_once(__DIR__ . '/__Class/ClassLoad.php');

//測試用，看錯誤訊息
ini_set('display_errors', '1');
error_reporting(E_ALL);

$S_UserName = BaseWork::_post('S_UserName');
$S_PassWord = BaseWork::_post('S_PassWord');
$S_RememberMe = BaseWork::_post('S_RememberMe');

$UserName = BaseWork::_post('UserName');
$PassWord = BaseWork::_post('PassWord');
$RememberMe = BaseWork::_post('RememberMe');

//檢查若還存在登入狀態則清除所有登入狀態
if (isset($_SESSION['SYS_Username']) || isset($_SESSION['COM_UserID']))
    session_destroy();

//登入使用者
if ($S_UserName != "")
    UserAction::SYS_Login($S_UserName, $S_PassWord, $S_RememberMe);

if ($UserName != "")
    UserAction::COM_Login($UserName, $PassWord, $RememberMe);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>登入 - 點燈系統</title>

    <meta name="description" content="User login page"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css"/>

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-part2.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    @media screen and (min-width: 480px) {
        .login-layout {
            background-image: url("assets/images/login_background.png") !important;
            background-size: 100% !important;
            background-repeat: no-repeat !important;
        }
    }

    @media screen and (max-width: 479px) {
        .login-layout {
            background-image: url("assets/images/mobile_login_background.png") !important;
            background-size: 100% auto !important;
            background-repeat: no-repeat !important;
        }
    }

    /*.login-layout{ background-image: url("assets/images/mobile_login_background.png") !important;background-size:100% !important;background-repeat:no-repeat !important; }	*/
    .it1 {
        font-size: 1.7em !important;
    }

    .it2 {
        font-size: 1.2em !important;
    }
</style>
<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <div class="it1">
                            <i class="ace-icon fa fa-cloud white"></i>
                            <span class="red">歡喜心好福報</span>
                            <span class="white" id="id-text2">點燈系統</span>
                        </div>
                        <div class="it2" id="id-company-text">Copyright &copy; <?= date("Y") ?> 三采國際開發有限公司.<br>All
                            rights
                            reserved.
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-building blue"></i>
                                        廟方帳號登入
                                    </h4>

                                    <div class="space-6"></div>

                                    <form id="Login_Form" name="Login_Form" method="POST">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="UserName" type="text" required="required"
                                                                   class="form-control" id="UserName"
                                                                   placeholder="Username"
                                                                   value="<?= BaseWork::cookie('remuser') ?>"/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="PassWord" type="password" required="required"
                                                                   class="form-control" id="PassWord"
                                                                   placeholder="Password"
                                                                   value="<?= Form_token_Core::URIAuthcode(BaseWork::cookie('rempwd')) ?>"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input name="RememberMe" type="checkbox" class="ace" id="RememberMe"
                                                           value="1" <?php
                                                    if (BaseWork::cookie('remchk')) echo "checked=\"checked\"";
                                                    ?> />
                                                    <span class="lbl"> 記住我的帳號</span>
                                                </label>

                                                <button type="submit"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">登入</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                    <!--
                                    <div class="social-or-login center">
                                        <span class="bigger-110">Or Login Using</span>
                                    </div>

                                    <div class="space-6"></div>

                                    <div class="social-login center">
                                        <a class="btn btn-primary">
                                            <i class="ace-icon fa fa-facebook"></i>
                                        </a>

                                        <a class="btn btn-info">
                                            <i class="ace-icon fa fa-twitter"></i>
                                        </a>

                                        <a class="btn btn-danger">
                                            <i class="ace-icon fa fa-google-plus"></i>
                                        </a>
                                    </div>
                                    -->
                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">

                                    <div>
                                        <!--
                                        <a href="#" data-target="#forgot-box" class="forgot-password-link">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            忘記密碼?
                                        </a>
                                        -->
                                    </div>


                                    <div>
                                        <a href="#" data-target="#signup-box" class="user-signup-link">
                                            工業設定登入
                                            <i class="ace-icon fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        忘記密碼
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        請輸入您註冊時輸入的電子信箱
                                    </p>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control"
                                                                   placeholder="Email"/>
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">發送</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        返回廟方帳號登入
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.forgot-box -->

                        <div id="signup-box" class="signup-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header green lighter bigger">
                                        <i class="ace-icon fa fa-server green"></i>
                                        工業設定登入
                                    </h4>

                                    <div class="space-6"></div>
                                    <p> 請登入您的管理員帳號: </p>

                                    <form id="SYS_Login_Form" name="SYS_Login_Form" method="POST">
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="S_UserName" type="text" required="required"
                                                                   class="form-control" id="S_UserName"
                                                                   placeholder="Username"
                                                                   value="<?= BaseWork::cookie('s_remuser') ?>"/>
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
														<input name="S_PassWord" type="password" required="required"
                                                               class="form-control" id="S_PassWord"
                                                               placeholder="Password"
                                                               value="<?= Form_token_Core::URIAuthcode(BaseWork::cookie('s_rempwd')) ?>"/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input name="S_RememberMe" type="checkbox" class="ace"
                                                           id="S_RememberMe" value="1" <?php
                                                    if (BaseWork::cookie('s_remchk')) echo "checked=\"checked\"";
                                                    ?> />
                                                    <span class="lbl">記住我的帳號</span>
                                                </label>

                                                <button type="submit"
                                                        class="width-35 pull-right btn btn-sm btn-success">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">登入</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        返回廟方帳號登入
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.signup-box -->
                    </div><!-- /.position-relative -->
                    <!--
                    <div class="navbar-fixed-top align-right">
                        <br />
                        &nbsp;
                        <a id="btn-login-dark" href="#">Dark</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-blur" href="#">Blur</a>
                        &nbsp;
                        <span class="blue">/</span>
                        &nbsp;
                        <a id="btn-login-light" href="#">Light</a>
                        &nbsp; &nbsp; &nbsp;
                    </div>
                    -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<?php SYSAction::DialogMsg(); ?>
<!-- basic scripts -->

<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">

    jQuery(function ($) {

        <?php SYSAction::DialogJs(); ?>

        $(document).on('click', '.toolbar a[data-target]', function (e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
        });

        //頁面樣式
        $('body').attr('class', 'login-layout blur-login');
        $('#id-text2').attr('class', 'white');
        $('#id-company-text').attr('class', 'light-blue');

        e.preventDefault();
        /*
         $('#btn-login-blur').on('click', function(e) {
            $('body').attr('class', 'login-layout blur-login');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'light-blue');

            e.preventDefault();
         });
         $('#btn-login-dark').on('click', function(e) {
            $('body').attr('class', 'login-layout');
            $('#id-text2').attr('class', 'white');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
         });
         $('#btn-login-light').on('click', function(e) {
            $('body').attr('class', 'login-layout light-login');
            $('#id-text2').attr('class', 'grey');
            $('#id-company-text').attr('class', 'blue');

            e.preventDefault();
         });
         */
    });
</script>
</body>
</html>
