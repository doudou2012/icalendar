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
    $(document).ready(function(){
        shared($(document).find('title').text(),location.href,'');
        if ($('.icalendar-slider').length > 0 ){
            $('.flexslider').css("margin","0");
            $('.flexslider').flexslider({"smoothHeight":true,"slideshowSpeed":3000,"controlNav":false,"directionNav":false});
        }
    });
})(jQuery);