jQuery(document).ready(function ($) {

    function getallimage() {
        var ajaxurl = 'http://127.0.0.1/wp-admin/admin-ajax.php';
        var data = {
            action: 'get_my_pic'
        };
        $('#load').removeClass('loader-removed');
        $.post(ajaxurl, data, function (result) {
            var ret = JSON.parse(result);
            var column = $(".uploadcolumns");
            column.empty();
            var childIndex = 0;
            if (ret.length > 0) {
                ret.forEach(element => {
                    // alert(element);
                    var childdiv = $('<div></div>'); //创建一个子div
                    childdiv.attr('id', 'child' + childIndex); //给子div设置id
                    childdiv.attr('class', 'uploadimage fit'); //添加css样式
                    var img = document.createElement("img");
                    img.setAttribute("id", "newImg" + childIndex);
                    img.src = "http://127.0.0.1" + element;　
                    childdiv.append(img);
                    
                    var childdiv2 = $('<div>删除</div>'); //创建一个子div
                    childdiv2.attr('id', 'childdel' + childIndex); //给子div设置id
                    childdiv2.attr('class', 'delimg'); //添加css样式
                    childdiv2.attr('data-name', element.substring(element.lastIndexOf('/')+1)); //添加css样式
                    childdiv.append(childdiv2);
                    column.append(childdiv); //将子div添加到父div中
                    childIndex++;
                    var childdiv2id = '#childdel' + childIndex;
                    $('.uploadcolumns').on('click', childdiv2id, function () {
                        var ajaxurl = 'http://127.0.0.1/wp-admin/admin-ajax.php';
                        var data = {
                            action: 'del_one_pic',
                            picinfo: this.getAttribute('data-name')
                        };

                        $('#load').removeClass('loader-removed');
                        $.post(ajaxurl, data, function (result) {
                            getallimage();
                        });
                    });
                });
            }
            // MaskUtil.unmask();
            $('#load').addClass('loader-removed');
        });
    }
    $('#aad_submit').click(function () {
        /*提交过程*/
        /*让loading图标显示*/
        // $('#aad_loading').show();
        /*让提交按钮不可用*/
        var formData = new FormData($('upload-form')[0]);
        // formData.append('file', $(':file')[0].files[0]);
        for (i = 0; i < $(':file')[0].files.length; i++) {
            formData.append('file[]', $(':file')[0].files[i]);
        }

        formData.append("upload", 1);
        formData.append('action', 'upload_images');
        /*返回相应数据*/
        var ajaxurl = 'http://127.0.0.1/wp-admin/admin-ajax.php';

        $('#load').removeClass('loader-removed');
        $.ajax({
            type: 'post',
            url: ajaxurl,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (result) {
                getallimage();
            },
            error: function (data) {
                alert("err");
            }
        });
        return false;
    });

    if ($("#uploadmain").length > 0) {
        getallimage();
    }
});