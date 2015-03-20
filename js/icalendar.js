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
        $('#add-fav').css({"pointer-events":"none","cursor":"not-allowed"});
        $('#add-fav').text('已收藏');
    };
    var showloginForm = function(){
        var sign = new Sign({login_success:function(){window.location.reload()}});
        sign.login_dialog();
    };
    /*添加收藏*/
    var addFavorite = function(pid){
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

    };
    /*检查是否已经收藏*/
    var checkFav = function(pid){
        if ($('#add-fav').length > 0){
            if (!pid || parseInt(pid) <=0) {
                pid = parseInt($('article:first').attr('id').replace(/[^\d]/g, ''));
            }
            if (pid > 0 ){
                $.getJSON(baseUrl+'?favorite&check_fav',{postid:pid},function(data){
                    if (data.success){
                        setDisabled();
                    }else{
                        $('#add-fav').on('click', function () {
                            addFavorite(pid);
                        });
                    }
                });
            }
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

        if ($('.nav-user').length > 0 ){
            $('.nav-user').on('click',function(){
                location.href = baseUrl + '?favorite';
            });
        }
        if ($('.nav-city').length > 0){
            $('.nav-city').on('click',function(){
                $('.city-artist').removeClass('hidden');
                $.layer({type:1,title:"城市和艺术家列表",area:['240px','400px'],closeBtn:[1,true],move:false,maxWidth:300,fadeIn:200,shift:'top',page:{dom:'#city-artist'}});
            });

        }
        checkFav(0);
    });
})(jQuery);