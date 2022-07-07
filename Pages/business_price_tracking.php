<!-- 引入自寫CSS -->
<link rel="stylesheet" type="text/css" href="../assets/css/business_price_tracking.css">

<!-- 引入font-awesome的CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class='price_tracking'>
    <div class="form_block">
        <div class='top_bar'>
            <h3>物品價格追蹤test3</h3>
            <div class='left_icon'>
                <div class='list_btn'>
                    <i class="fa-solid fa-list-ul"></i>
                </div>
                <div class='plus_btn'>
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class='setting_btn'>
                    <i class="fa-solid fa-gear"></i>
                </div>
            </div>
            
        </div>
        <form  method="post" action='./Pages/ajax/business_price_tracking_form.php' name='price_tracking' class="form_price_tracking">
            <label for=''>分類:</label>
            <select class='select_classification_blind_box' name='classification_blind_box'></select>
            <label>+</label>
            <select class='select_classification_sub' name='classification_sub'></select><br/>

            <label for='item_name'>名稱:</label>
            <select class='item_name' name='name'></select>
            <label>價格:</label>
            <input name='price'/><br/>

            <div class='state_block'>
                <label>狀態:</label>
                <div class='radio_group'>
                    <label><input type="radio" name="state" id='presell' value="預售">預售</label>
                    <label><input type="radio" name="state" id='selling' value="銷售中">銷售中</label>
                    <label><input type="radio" name="state" id='sold_out' value="完售">完售</label>
                </div>
            </div>

            <label>分類:</label>
            <select class='select_classification' name='classification'></select>            
            <label>來源:</label>
            <select class='select_source' name='source'></select><br/>
            
            <label>網址:</label>
            <input class="web_address"name='web_address'/><br/>
            <label>備註:</label>
            <input class="remark" name='remark'/>
        </form>
        <div class="btn">
            <div class="submit_btn">送出</div>
        </div>
        <div class='mask'></div>
    </div> 
    <!-- <audio autoplay loop>
        <source src="/Assistant/assets/music/test.mp3">
    </audio> -->
</div>

<div class='plus_dialog'>
    <form  method="post" action='./Pages/ajax/business_price_tracking_form_add_product.php' name='form_add_product' class='form_add_product'>
        <h3>新增商品</h3>
        <div class='add_product_left_icon'>
            <div class='setting'>
                <i class="fa-solid fa-gear"></i>
            </div>
            <div class='x'>
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div>分類</div>
        <input name='dia_add_classification' class='dia_add_classification'/>
        <div class='plus'>+</div>
        <input name='dia_add_classification_sub' class='dia_add_classification_sub'/>
        <hr>
        <div>名稱</div>
        <input name='dia_add_item_name' class='dia_add_item_name'/>
        <hr>
        <div class='btn'>
            <div class='add_btn'>新增</div>
        </div>
        
    </form>
</div>

<!-- <div class='default_setting_dialog'>
    <form  method="post" action='./Pages/ajax/business_price_tracking_form_add_product.php' name='form_add_product' class='form_add_product'>
        <h3>新增商品</h3>
        <div class='add_product_left_icon'>
            <div class='setting'>
                <i class="fa-solid fa-gear"></i>
            </div>
            <div class='x'>
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>
        <div>分類</div>
        <input name='dia_add_classification' class='dia_add_classification'/>
        <div class='plus'>+</div>
        <input name='dia_add_classification_sub' class='dia_add_classification_sub'/>
        <hr>
        <div>名稱</div>
        <input name='dia_add_item_name' class='dia_add_item_name'/>
        <hr>
        <div class='btn'>
            <div class='add_btn'>新增</div>
        </div>
        
    </form>
</div> -->
<div class='setting_dialog'></div>