// app.js 核心扩展
layui.define(['jquery','layer','laytpl',"app"],function(exports){ 
    var $ = layui.jquery,layer=layui.layer,laytpl=layui.laytpl,app=layui.app;
    var o={};

    // 加载api
    o.loadApi=function(name){
        var m={};
        
        if (typeof name== 'string' ){
            if (!layui[name]) {
                m[name] = '{/}/static/layui/api/' + name
            }
        }else{
            for (let i = 0; i < name.length; i++) {
                const element = name[i];
                if (!layui[element]){
                    // console.log('加载欧快', element);
                    m[element] = '{/}/static/layui/api/' + element
                }
                
            }
        }
        layui.extend(m)
    }

    // 模板渲染
    o.tplRender=function(elem,params,renderElem,callback){
        laytpl($(elem).html()).render(params, function (html) {
            if (renderElem) $(renderElem).html(html);
            if (callback) callback(html);
        })
    }

    // 路由
    o.route={
        "app_index":"",
        "home": "/obj/getpage/p/home",// 首页 日历列表+内容
        "fullContent": "/obj/getpage/p/full_content",// 全屏日历
        "objSetting": "/obj/getpage/p/obj_setting",// 项目设置
    }


   
    exports('my_base', o);
});    


