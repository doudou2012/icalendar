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
    }
    $(document).ready(function(){
        shared('分享内容','http://icalendar.bbwc.cn','');
    });
})(jQuery);
