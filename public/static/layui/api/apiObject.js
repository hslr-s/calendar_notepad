// API 接口 - 项目类

layui.define(['jquery', 'layer'], function (exports) {
    var domain=""
    o={}
    o.getObjectList=function(page,limit,callbackList){
        
        app.base.ajaxPost(domain + "/calendar/objectapi/getList?page=" + page + "&limit=" + limit, {}, callbackList)
    }

    // 密码验证
    o.passwordCheck = function (objId, password, callback,errCallback) {
        app.base.ajaxPost(domain + "/calendar/objectapi/pwdCheck?obj_id=" + objId, { pwd: password }, callback, errCallback)
    }

    // 获取项目配置
    o.getConfig = function (objId, callback) {
        app.base.ajaxGet(domain + "/calendar/objectapi/getConfig?obj_id=" + objId, callback)
    }

    // 获取项目设置
    o.getConfig = function (objId, callback) {
        app.base.ajaxGet(domain + "/calendar/objectapi/getSetting?obj_id=" + objId, callback)
    }

    // 获取假期的数据
    o.getHolidayList = function (objId, start_time, end_time, callback) {
        var data = {};
        data.start_time = start_time;
        data.end_time = end_time;
        app.base.ajaxPost(domain + "/calendar/eventapi/getHolidayList?obj_id=" + objId, data, callback)
    }

    // 获取详情
    o.getInfo = function (objId, callback) {
        app.base.ajaxGet(domain + "/calendar/objectapi/getInfo?obj_id=" + objId, callback)
    }

    // 找回密码
    o.retrievePassword = function (objId, callback, errCallback) {
        app.base.ajaxGet(domain + "/calendar/objectapi/retrievePassword?obj_id=" + objId, callback, errCallback)
    }

    // 更新数据
    o.update = function (objId, data, callback){
        app.base.ajaxPost(domain + "/calendar/objectapi/update?obj_id=" + objId, data, callback)
    }

    // 删除项目
    o.delete = function (objId, name, callback,errCallback) {
        var postData={}
        postData['obj_id'] = objId;
        postData['name'] = name;
        app.base.ajaxPost(domain + "/calendar/objectapi/delete?obj_id=" + objId, postData, callback, errCallback)
    }




    exports('apiObject', o);
});