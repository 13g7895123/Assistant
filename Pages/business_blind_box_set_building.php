<!-- 引入自寫CSS -->
<link rel="stylesheet" type="text/css" href="../assets/css/business_blind_box_set_building.css">

<div class='business_blind_box_set_building'>
    <div class="form_block">
        <div class='title'>
            <h3>盲盒分類建置</h3>
            <div class='show_list_btn'>切換列表</div>
        </div>
        <div class='action_building'>
            <form  method="post" action='./Pages/ajax/business_blind_box_set_building_form.php' name='business_blind_box_set_building' class="form_business_blind_box_set_building">
                <label for='set_name'>系列名稱:</label>
                <input class='input_name' name='set_name'/>
                <label>+</label>
                <input name='set_sub_name'/><br/>
            </form>
            <div class="btn">
                <div class="submit_btn">送出</div>
            </div>
        </div>
    </div>
</div>