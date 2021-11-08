// app.js 核心扩展
layui.define(['jquery','layer','laytpl',"app"],function(exports){ 
    var $ = layui.jquery,layer=layui.layer,laytpl=layui.laytpl,app=layui.app;
    var o={};
    var layerButtonStyle={}

    function init(){
        
        // 弹窗样式扩展
        
        // 警告
        layerButtonStyle['primary'] = 'border-color: #d2d2d2;background: 0 0;color: #666;';
        layerButtonStyle['warm'] = 'background-color: #FFB800;color:#fff;border-color: #FFB800;';
        layerButtonStyle['danger'] = 'background-color: #FF5722;color:#fff;border-color: #FF5722;';
        
    }
    init();

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

    // 弹窗
    o.layer = function (obj) {
        layerButtonStyle['warm'];
        var btnStyleStr="";
        if (!obj.btn){
            obj.btn=[];
            if (obj.buttons) {
                for (let i = 0; i < obj.buttons.length; i++) {
                    const element = obj.buttons[i];
                    obj.btn.push(element.title);
                    if(i==0){
                        obj['yes'] = element.onClick
                    }else{
                        obj['btn'+(i+1)] = element.onClick
                    }
                    if (element.type){
                        btnStyleStr += layerButtonStyleGetContent(obj.skin, i, element.type)
                    }
                    
                    
                }
            }
        }
        
        var layerIndex=layer.open(obj);
        // 渲染样式
        $('#page-content').append('<style></style>');
        $('#page-content style').append(btnStyleStr);
    }

    function layerButton(title,className){
        return '<button type="button" class="layui-btn ' + className+'">' + title +'</button>';
    }

    function layerButtonStyleGetContent(layerskin,btnIndex,type){
        if (layerButtonStyle[type]){
            return '.' + layerskin+' .layui-layer-btn' + btnIndex + '{' + layerButtonStyle[type]+'}';
        }
        return '';
    }


    // 路由
    o.route={
        "app_index":"",
        "home": "/obj/home",// 首页 日历列表+内容
        "fullContent": "/obj/full_content",// 全屏日历
        "objSetting": "/obj/obj_setting",// 项目设置
    }

    

   
    exports('my_base', o);
});    


