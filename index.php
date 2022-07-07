<?php

include_once(__DIR__ . '/__Class/ClassLoad.php');

$NOW_Page = 'business_price_tracking';
if (BaseWork::_get('PageName') != "" && file_exists('Pages/' . BaseWork::_get('PageName') . '.php')) {
    $NOW_Page = BaseWork::_get('PageName'); //帶入目前PageName
}

?>

<!DOCTYPE html>
<html lang="zh-tw" >
<head>
    <meta charset="UTF-8">
    <title>Assistant</title>

    <!-- 引入JQuery -->
    <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
    
    <!-- 引入Bootstrap的CSS -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">

    <!-- 引入font-awesome的CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css"> -->

    <!-- 引入Bootstrap的js -->
    <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>

    <!-- 引入Vue.js -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js'></script>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" width=20px></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Business
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?PageName=business_price_tracking">價格追蹤</a></li>
                            <li><a class="dropdown-item" href="?PageName=business_blind_box_set_building">分類建置</a></li>
                            <li><a class="dropdown-item" href="?PageName=business_">商品需求</a></li>
                            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?PageName=bs_test">bs_test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?PageName=plan01">plan01</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="page-content container">
        <!-- PAGE CONTENT BEGINS -->                
        <?php
            //顯示頁面
            include('Pages/' . $NOW_Page . '.php');
        ?>
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.page-content -->
    
</body>
<script>
    $(document).ready(function() {
        <?php
            include(__DIR__ . '/Pages/js/' . $NOW_Page . '.js');
        ?>
    })
</script>