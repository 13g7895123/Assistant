/**
 4. 自定義文件上傳列 
 5. @param value
 6. @param editOptions
 7. @returns {*|jQuery|HTMLElement}
 8. @constructor
 */
function ImgUpload(value, editOptions) {
    var span = $("<span>");
    var hiddenValue = $("<input>",{type:"hidden", val:value, name:"fileName", id:"fileName"});
    var image = $("<img>",{name:"uploadImage", id:"uploadImage",value:'',style:"display:none;width:80px;height:80px"});
    var el = document.createElement("input");
    el.type = "file";
    el.id = "imgFile";
    el.name = "imgFile";
    el.onchange = UploadFile;
    span.append(el).append(hiddenValue).append(image);
    return span;
}
/**
 9. 調用 ajaxFileUpload 上傳文件 
 10. @returns {boolean}
 11. @constructor
 */
function UploadFile() {
    $.ajaxFileUpload({
        url : 'index.php/Home/upload/upload',
        type : 'POST',
        secureuri:false,
        fileElementId: 'imgFile',
        dataType : 'json',
        success: function(data,status){
            //顯示圖片 
            $("#fileName").val(data.id);
            $("#uploadImage").attr("src","index.php/Home/download/download?id=" + data.id);
            $("#uploadImage").show();
            $("#imgFile").hide()
        },
        error: function(data, status, e){
            alert(e);
        }
    });
    return false;
}
/**
 12. icon 編輯的時候該列對應的實際值 
 13. @param elem
 14. @param sg
 15. @param value
 16. @returns {*|jQuery}
 17. @constructor
 */
function GetImgValue(elem, sg, value){
    return $(elem).find("#fileName").val();
}