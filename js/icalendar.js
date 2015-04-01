/**
 * Created by user on 15/3/17.
 */
(function($){
    var baseUrl = window.location.pathname;
    var shared = function(content,url,img){
        var param = {"url":url};
        webridge.jsToNative('shared',param,function(result,error){
            console.log(result);
        });
    };
    var setDisabled = function(){
        if  ($('#add-fav').length > 0){
            $('#add-fav').off('click').attr('disabled','disabled');
            var i = $('#add_fav').find('i')[0];
            $(i).removeClass('glyphicon-heart-empty').addClass('glyphicon-heart');
        }
        //$('#add-fav').attr("disabled", "disabled");
        //$('#add-fav').css({"pointer-events":"none","cursor":"not-allowed"});
        //$('#add-fav').text('已收藏');
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
    var addParameter = function (param){
        _url = location.href;
        _url += (_url.split('?')[1] ? '&':'?') + param;
        return _url;
    };
    var layer_index;
    $(document).ready(function(){
        if ($('#add_fav').length > 0){
            $('#add_fav').on('click',function(){
                pid = parseInt($('article:first').attr('id').replace(/[^\d]/g, ''));
                if (pid > 0){
                    addFavorite(pid);
                }
            });
        }
        if ($('#invite-friends').length > 0){
            //邀请好友

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
                location.href = addParameter(' favorite&post_type=event');
            });
        }
        if ($('.nav-city').length > 0){
            $('.nav-city').on('click',function(){
                $('#city-artist').removeClass('hidden');
                layer_index = $.layer({type:1,title:"城市和艺术家列表",area:['100%','100%'],closeBtn:[1,true],move:false,maxWidth:360,fadeIn:200,shift:'top',page:{dom:'#city-artist'},success:function(layero){
                    $('.xubox_layer').css('top',0);
                }});
                $('#city-artist ul a').each(function(item){
                    $(item).off('click');
                    $(item).on('click',function(){
                        $.layer.closeAll();
                    })
                });
            });
        }
        if ($('#slider-home').length > 0){
            $("#slider-home").excoloSlider();
        }
        if ($('#slider-single').length > 0){
            $("#slider-single").excoloSlider();
        }

        $('a').on('click',function(){
            $('a').removeClass('active');
            $(this).addClass('active');
        });

        if ($('#invite-friends').length > 0){
            $('#invite-friends').on('click',function(){
                pid = parseInt($('article:first').attr('id').replace(/[^\d]/g, ''));
                document.location.href = baseUrl + '?invite&form&pid='+pid;
            });
        }

        if ($('#send_invite').length > 0){
            $('#send_invite').on('click',function(){
                var pid = parseInt($('#p_id').val()),
                    date = encodeURIComponent($('input[name="date"]').val());
                var share_url = location.protocol+'//'+location.host + baseUrl + '?invite&info&pid='+pid+'&date='+date;
                shared('',share_url);
            });
            $('#cancel_invite').on('click',function(){
                history.go(-1);
            });
        }
        if ($('#accept-invite').length > 0){
            $('#accept-invite').on('click',function(){
                var pid = parseInt($('article:first').attr('id').replace(/[^\d]/g, ''));
                layer.prompt({title:"称呼",length:20},function(val, index, elem){
                    var reqUrl = baseUrl+'?invite&accept';
                    $.getJSON(reqUrl,{pid:pid,nick:encodeURIComponent(val)},function(data){
                        //$.layer.closeAll();
                        if (data.success){
                            location.reload();
                            //location.href= baseUrl+'?invite&info&pid'+pid;
                        }
                    });
                });
            });
        }
    });
})(jQuery);