/**
 * Created by user on 15/3/17.
 * scroll http://excolo.github.io/Excolo-Slider/
 */
(function($){
    var baseUrl = window.location.pathname;
    var shared = function(content,url,img){
        var param = {"title":content,"url":url};
        webridge.jsToNative('shared',param,function(result,error){
            console.log(result);
        });
    };
    var changeStatus = function(op){
        if  ($('#add_fav').length > 0){
            var i = $('#add_fav').find('i')[0],
                del_class='glyphicon-heart',add_class='glyphicon-heart-empty';
            if  (op == 1) {
                del_class = 'glyphicon-heart-empty';
                add_class = 'glyphicon-heart';
            }
            $(i).removeClass(del_class).addClass(add_class);
        }
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
                changeStatus(data.data);
            } else if (data.error.code == 'not_login') {
                showloginForm();
            } else {
                alertify.alert('操作失败:' + data.error.msg).set('basic', true);
                setTimeout(function () {
                    alertify.close();
                }, 3000);
            }
        });

    };
    var addParameter = function (param){
        _url = location.href;
        _url += (_url.split('?')[1] ? '&':'?') + param;
        return _url;
    };

    var addQueryParam = function( url, key, val ){
        var parts = url.match(/([^?#]+)(\?[^#]*)?(\#.*)?/);
        var url = parts[1];
        var qs = parts[2] || '';
        var hash = parts[3] || '';

        if ( !qs ) {
            return url + '?' + key + '=' + encodeURIComponent( val ) + hash;
        } else {
            var qs_parts = qs.substr(1).split("&");
            var i;
            for (i=0;i<qs_parts.length;i++) {
                var qs_pair = qs_parts[i].split("=");
                if ( qs_pair[0] == key ){
                    qs_parts[ i ] = key + '=' + encodeURIComponent( val );
                    break;
                }
            }
            if ( i == qs_parts.length ){
                qs_parts.push( key + '=' + encodeURIComponent( val ) );
            }
            return url + '?' + qs_parts.join('&') + hash;
        }
    }

    var fetch_data = function(page){
        var request_url = addQueryParam(document.location.href, 'paged',page);
    }
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
                shared($('h1.entry-title').text(),location.href,'');
            });
        }

        if ($('.nav-user').length > 0 ){
            $('.nav-user').on('click',function(){
                location.href = addParameter('favorite&post_type=event');
            });
        }
        //if ($('.nav-city').length > 0){
        //    $('.nav-city').on('click',function(){
        //        $('#city-artist').removeClass('hidden');
        //        layer_index = $.layer({type:1,title:"城市和艺术家列表",area:['100%','100%'],closeBtn:[1,true],move:false,maxWidth:360,fadeIn:200,shift:'top',page:{dom:'#city-artist'},success:function(layero){
        //            $('.xubox_layer').css('top',0);
        //        }});
        //        $('#city-artist ul a').each(function(item){
        //            $(item).off('click');
        //            $(item).on('click',function(){
        //                $.layer.closeAll();
        //            })
        //        });
        //    });
        //}
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
                    date = encodeURIComponent($('input[name="date"]').val()),
                    title = $('#post_title').val();
                var share_url = location.protocol+'//'+location.host + baseUrl + '?invite&info&pid='+pid+'&date='+date;
                shared(title,share_url);
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
                        if (data.success){
                            location.reload();
                            //location.href= baseUrl+'?invite&info&pid'+pid;
                        }
                    });
                });
            });
        }

        if ($('#show_detail').length > 0){
            $('#show_detail').on('click',function(){
                $('.entry-content').toggle(400,'linear');
            });
        }

        /**
         * scroll list
         */
        //var scroll = '';
        //if ($('article').length > 1){
        //    scroll =  new IScroll('#content',{
        //        mouseWheel:true,
        //        infiniteElements:'article',
        //        infiniteLimit:2000,
        //        //dataset:
        //        cacheSize:20
        //    });
        //}

    });
})(jQuery);