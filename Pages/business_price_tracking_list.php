<!-- 引入自寫CSS -->
<link rel="stylesheet" type="text/css" href="../assets/css/business_price_tracking_list.css">

<!-- 引入font-awesome的CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class='price_tracking_list'>

    <div class='show_table'>
        <div class='title'>
            <h3>追蹤列表</h3>
            <input class='input_search_item'>
        </div>
        <div class='table_content'>
            <div class='table_head'>
                <div>系列名稱</div>
                <div>系列子名稱</div>
                <div>公仔名稱</div>
                <div>價格</div>
                <div>狀態</div>
                <div>來源</div>
            </div>
            <hr>
            <div class='table_row_content'>
                <div class='table_row' v-for='data in datas'>
                    <div>{{data.set_name}}</div>
                    <div>{{data.set_sub_name}}</div>
                    <div>{{data.item_name}}</div>
                    <div>{{'$ ' + data.price}}</div>
                    <div>{{data.state == 'presell'? '預購': data.state == 'selling'? '銷售中': '完售'}}</div>
                    <div><a href='{{data.web_address}}' target="_blank">{{data.source_name}}</a></div>
                </div>
            </div>            
        </div>
    </div>
</div>