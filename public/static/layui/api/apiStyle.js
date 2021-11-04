// API 接口 - 风格类

layui.define(['jquery', 'layer'], function (exports) {
    var domain=""
    o={}
    o.getList=function(callbackList){
        
        app.ajaxGet(domain + "/calendar/style/getStyleList",function(res){
            if (res.code==1){
                callbackList(res.data)
            }
        })
    }


    exports('apiStyle', o);
});