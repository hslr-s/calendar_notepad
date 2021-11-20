// API 接口 - 登录、注册类

layui.define(['jquery', 'layer'], function (exports) {
    var domain=""
    o={}
    o.check = function (username, password, callback, errCallback){
        var postdata={};
        postdata['username'] = username;
        postdata['password'] = password;
        app.base.ajaxPost(domain + "/calendar/loginapi/check", postdata, callback,errCallback)
    }

    o.logout = function (callback, errCallback) {
        app.base.ajaxGet(domain + "/calendar/loginapi/logout", callback, errCallback)
    }

    // 提交注册
    o.registerSubmit = function (username, password, name, callback, errCallback) {
        var postdata = {};
        postdata['username'] = username;
        postdata['password'] = password;
        postdata['name'] = name;
        postdata['callback_url'] = location.href.split('#')[0]+'#'+app.base.route.linkRegister;
        app.base.ajaxPost(domain + "/calendar/loginapi/registerSubmit", postdata, callback, errCallback)
    }

    // 链接注册
    o.linkRegister = function (code, callback, errCallback) {
        app.base.ajaxGet(domain + "/calendar/loginapi/linkRegister?code=" + code, callback, errCallback)
    }

    // 获取开放信息
    o.getOpenInfo = function (callback, errCallback) {
        app.base.ajaxGet(domain + "/calendar/loginapi/getOpenInfo", callback, errCallback)
    }




    exports('apiLogin', o);
});