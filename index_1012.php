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
        <!-- <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script> -->
        
        <!-- 引入Bootstrap的CSS -->
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/css/bootstrap.min.css">

        <!-- 引入font-awesome的CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"> -->
        <!-- <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css"> -->

        <!-- 引入Bootstrap的js -->
        <!-- <script src="https://cdn.staticfile.org/popper.js/2.9.3/umd/popper.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script> -->

        <!-- 引入Vue.js -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.js'></script>

        <!-- 引入自寫CSS -->
        <link rel="stylesheet" type="text/css" href="./assets/css/index.css">

        <!-- 引入字體 -->
        <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"> 

        <!-- 引入jQuery Editable Select -->
        <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.js"></script>
        <link href="//rawgithub.com/indrimuska/jquery-editable-select/master/dist/jquery-editable-select.min.css" rel="stylesheet">

        <link href="/dist/output.css" rel="stylesheet">
        <script src='https://cdn.tailwindcss.com'></script>
        <!-- <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            clifford: '#da373d'
                        }
                    }
                }
            }
        </script>
        <style type='text/tailwindcss'>
            @layer utilities {
                .content-auto {
                    content-visibility: auto;
                }
            }
        </style> -->

    </head>
    <body>
        <div class='nav_bar'>
            <div class='nav_main'>
                <div class='left'>
                    <div class='nav_block stock'>
                        <label class='drop_down'>Stock</label>
                        <div class='dropdown_content'>
                            <a href='?PageName=stock_legal_person' style='text-decoration:none'><div class='first_section'>法人買賣超</div></a>
                            <a href='#' style='text-decoration:none'><div>2</div></a>
                            <a href='#' style='text-decoration:none'><div>3</div></a>
                        </div>                    
                    </div>
                    <div class='nav_block business'>
                        <label class='drop_down'>Business</label>
                        <div class='dropdown_content'>
                            <a href='?PageName=business_price_tracking' style='text-decoration:none'><div class='first_section'>盲盒</div></a>
                            <a href='#' style='text-decoration:none'><div>2</div></a>
                            <a href='#' style='text-decoration:none'><div>3</div></a>
                        </div> 
                    </div>
                    <div class='nav_block assistant'>
                        <label class='drop_down'>Assistant</label>
                        <div class='dropdown_content'>
                            <a href='?PageName=ass_db_user_create' style='text-decoration:none'><div>DB User建立</div></a>
                            <a href='?PageName=tailwind_test' style='text-decoration:none'><div>tailwind</div></a>
                            <a href='#' style='text-decoration:none'><div>3</div></a>
                        </div> 
                    </div>
                    <!-- <div class='nav_block'>3</div> -->
                </div>
                <div class='logo'>
                    <img src='./assets/images/test logo_100.png' with="100" heigh="100" alt="LOGO">
                </div>
                <div class='right'>
                    <div class='nav_block'>1</div>
                    <div class='nav_block'>2</div>
                    <div class='nav_block'>3</div>
                </div>
            </div>
        </div>
        
        <div class="container">
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
            const ajax_url = "<?php if ($NOW_Page) echo './Pages/ajax/' . $NOW_Page . '.php'; ?>";
            <?php
                include(__DIR__ . '/Pages/js/' . $NOW_Page . '.js');
            ?>
        })
    </script>
</html>