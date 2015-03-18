/**
 * Created by user on 15/3/17.
 */
(function($){
    var baseUrl = window.location.pathname;
    var shared = function(content,url,img){
        var param = {"content":content,"url":url,"image":img};
        webridge.jsToNative('shared',param,function(result,error){
            console.log(result);
        });
    };
    var setDisabled = function(){
        $('#add-fav').attr("disabled", "disabled");
        $('#add-fav').css({"background-color":"#666","opacity":.65,"pointer-events":"none","cursor":"not-allowed"});
        $('#add-fav').text('已收藏');
    };
    var showloginForm = function(){
        var sign = new Sign({login_success:function(){window.location.reload()}});
        sign.login_dialog();
    };
    var addFav = function(pid){
        if ($('#add-fav').length > 0){
            if (!pid || parseInt(pid) <=0) {
                pid = $('article:first').attr('id').replace(/[^\d]/g, '');
            }
            $('#add-fav').on('click', function () {
                var url = baseUrl + '?favorite&add';
                $.getJSON(url, {postid: pid}, function (data) {
                    if (data.success) {
                        setDisabled();
                    } else if (data.error.code == 'not_login') {
                        showloginForm();
                    } else {
                        alertify.alert('收藏失败:' + data.error.msg).set('basic', true);
                        setTimeout(function () {
                            alertify.close();
                        }, 3000);
                    }
                });
            });
        }else{
            return false;
        }
    };
    $(document).ready(function(){
        if ($('.icalendar-slider').length > 0 ){
            $('.flexslider').css("margin","0");
            $('.flexslider').flexslider({"smoothHeight":true,"slideshowSpeed":3000,"controlNav":false,"directionNav":false});
        }
        if ($('.nav-back').length > 0){
            $('.nav-back').on('click',function(){
                history.go(-1);
            });
        }
        if ($('.nav-share').length > 0){
            $('.nav-share').on('click',function(){
                shared($(document).find('title').text(),location.href,'');
            });
        }
        addFav();
    });
})(jQuery);