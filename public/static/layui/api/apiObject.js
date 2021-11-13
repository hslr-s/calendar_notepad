// API 接口 - 项目类

layui.define(['jquery', 'layer'], function (exports) {
    var domain=""
    o={}
    o.getObjectList=function(page,limit,callbackList){
        
        app.ajaxPost(domain + "/calendar/objectapi/getList?page=" + page + "&limit=" + limit,{},function(res){
            if (res.code==1){
                callbackList(res.data)
            }
        })
    }

    // 密码验证
    o.passwordCheck = function (objId, password, okCallback,errCallback) {
        app.ajaxPost(domain + "/calendar/objectapi/pwdCheck?obj_id=" + objId, { pwd: password}, function (res) {
            if (res.code == 1) {
                okCallback()
            }else{
                errCallback()
            }
        })
    }

    // 获取项目配置
    o.getConfig = function (objId, callback) {
        app.ajaxGet(domain + "/calendar/objectapi/getConfig?obj_id=" + objId, function (res) {
            if (res.code == 1) {
                callback(res.data)
            }
        })
    }

    // 获取项目设置
    o.getConfig = function (objId, callback) {
        app.ajaxGet(domain + "/calendar/objectapi/getSetting?obj_id=" + objId, function (res) {
            if (res.code == 1) {
                callback(res.data)
            }
        })
    }

    // 获取假期的数据
    o.getHolidayList = function (objId, start_time, end_time, callback) {
        var data = {};
        data.start_time = start_time;
        data.end_time = end_time;
        app.ajaxPost(domain + "/calendar/eventapi/getHolidayList?obj_id=" + objId, data, function (res) {
            if (res.code == 1) {
                callback(res.data)
            }
        })
    }

    // 获取详情
    o.getInfo = function (objId, callback) {
        app.ajaxGet(domain + "/calendar/objectapi/getInfo?obj_id=" + objId, function (res) {
            if (res.code == 1) {
                callback(res.data)
            }
        })
    }

    // 更新数据
    o.update = function (objId, data, callback){
        app.ajaxPost(domain + "/calendar/objectapi/update?obj_id=" + objId, data, function (res) {
            if (res.code == 1) {
                callback(res.data)
            }
        })
    }

    // 删除项目
    o.delete = function (objId, name, callback,errCallback) {
        var postData={}
        postData['obj_id'] = objId;
        postData['name'] = name;
        app.ajaxPost(domain + "/calendar/objectapi/delete?obj_id=" + objId, postData, function (res) {
            if (res.code == 1) {
                callback(res.data)
            }else{
                errCallback(res.msg);
            }
        })
    }




    exports('apiObject', o);
});