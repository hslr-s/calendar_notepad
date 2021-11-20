// API 接口 - 用户

layui.define(['jquery', 'layer'], function (exports) {
    var domain = "/calendar/userapi/", postdata={}
    o={}

    

    // 获取用户信息
    o.getUserInfo = function (okCallback, errCallback) {
        app.base.ajaxGet(domain + "getUserInfo", okCallback, errCallback)
    }


    exports('apiUser', o);
});