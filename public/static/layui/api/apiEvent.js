// API 接口 - 事件类

layui.define(['jquery', 'layer'], function (exports) {
    var domain = "", postdata={}
    o={}

    o.visit_password=null;
    // o.getObjectList=function(page,limit,callbackList){
        
    //     app.base.ajaxPost(domain + "/calendar/objectapi/getList?page=" + page + "&limit=" + limit,{},function(res){
    //         if (res.code==1){
    //             callbackList(res.data)
    //         }
    //     })
    // }

    


    o.update = function (objId, data, callback) {
        postdata = {}
        postdata['event_id'] = data.event_id;
        postdata['start_time'] = data.startTime;
        postdata['end_time'] = data.endTime;
        postdata['title'] = data.title;
        postdata['class_name'] = data.className;
        postdata['color'] = data.color;
        postdata['content'] = data.content;
        app.base.ajaxPost(domain + "/calendar/eventapi/update?obj_id=" + objId, postdata, callback)
    }

    o.add = function (objId, data, callback,errCallback) {
        postdata = {}
        postdata['start_time'] = data.startTime;
        postdata['end_time'] = data.endTime;
        postdata['title'] = data.title;
        postdata['class_name'] = data.className;
        postdata['color'] = data.color;
        postdata['content'] = data.content;
        app.base.ajaxPost(domain + "/calendar/eventapi/add?obj_id=" + objId, postdata, callback, errCallback)
    }

    o.delete = function (objId, eventId, callback, errCallback) {
        postdata = {}
        postdata["event_id"] = eventId;
        // postdata['pwd'] = o.visit_password;
        app.base.ajaxPost(domain + "/calendar/eventapi/delete?obj_id=" + objId, postdata, callback, errCallback)
    }

    
    o.getList = function (objId, start_time,end_time, callback,pwdCallback) {
        postdata = {}
        postdata.start_time = start_time;
        postdata.end_time = end_time;
        postdata['pwd'] = o.visit_password;
        app.base.ajaxPost(domain + "/calendar/eventapi/getList?obj_id=" + objId, postdata, callback, pwdCallback)
    }

    




    exports('apiEvent', o);
});