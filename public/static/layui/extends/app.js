layui.define(['jquery','layer','laytpl'],function(exports){ 
    var $ = layui.jquery,layer=layui.layer,laytpl=layui.laytpl;

    // 属性
    var eContent, oTpl = {}, events = {}, contentElemId="page-content";
    var pageCacheC={};
    var route={'old':'','new':''};

    // 系统事件
    // routeChange(newRoute,oldRoute) 路由变化
    // pageClose() 页面关闭

    // 配置
    var Config={
        viewUrlPrefix: '', // 页面路径的前缀
        viewUrlApi:null, // 页面请求接口
        templatePath: '/template/', // 模板路径
    }

    // 变量
    // var pageJumpTag = 1;
    var hashChangeListen={};

    function go(_url){
        if (_url == '' || _url == '/') {
            return;
        }
        setUrl(_url);
    }

    function goToPage(_url){
        setUrl(_url);
        loadPage();
    }

    // 设置浏览器地址 但是不会进行跳转
    function setUrl(_url) {
        route.old=getRoute();
        location.hash = _url;
    }

    function open(_url){
        window.open('/#'+_url)
        
    }

    function ajaxGet(_url,_success,_error){
        $.ajax({
            url:_url,
            headers: {
                Token: layui.data('userInfo').token
            },
            async:true,
            success:function(d){
                if(d.err_code==1001){
                    layer.alert('登录失效',function(){
                        location.href='/login/index'
                    });
                }else{
                    if (_success){
                        _success(d)
                    }
                }
            },
            error:_error
        })
    }

    function ajaxPost(_url,data,_success,_error){
        
        $.ajax({
            url:_url,
            type:'post',
            async: true,
            headers: {
                Token: layui.data('userInfo').token
            },
            data:data,
            success:function(d){
                if(d.err_code==1001){
                    layer.alert('登录失效',function(){
                        location.href='/login'
                    });
                }else{
                    if (_success) {
                        _success(d)
                    }
                }
            },
            error:_error
        })
    }

    function parseUrl(href) {
        // var href = href || window.location.href;
        var href = href || getRoute();
        return parse_url(href);
        function parse_url(url) {  
             var a =  document.createElement('a');  
             a.href = url;  
             return{  
                 source: url,  
                 protocol: a.protocol.replace(':',''),  
                 host: a.hostname,  
                 port: a.port,  
                 query: a.search,  
                 params: (function(){  
                     var ret = {},  
                         seg = a.search.replace(/^\?/,'').split('&'),  
                         len = seg.length, i = 0, s;  
                     for (;i<len;i++) {  
                         if (!seg[i]) { continue; }  
                         s = seg[i].split('=');  
                         ret[s[0]] = decodeURI(s[1]);  
                     }  
                     return ret;  
                 })(),  
                 file: (a.pathname.match(/\/([^\/?#]+)$/i) || [,''])[1],  
                 hash: a.hash.replace('#',''),  
                 path: a.pathname.replace(/^([^\/])/,'/$1'),  
                 relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [,''])[1],  
                 segments: a.pathname.replace(/^\//,'').split('/')  
             };
        }    

    }

    function getUrl(){
        var router = location.hash
        
        // var num = str.indexOf("!");
        router = router.substr(1);
        // console.log("路由", router);
        return router;
    }
    function getRoute(){
        return getUrl();
    }

    function init(obj){
        eContent=$(obj.contentElemId)

        // 初始化赋值配置
        if(obj.config){
            for (const k in obj.config) {
                if (k in Config){
                    Config[k] = obj.config[k]
                }
            }
        }
        // console.log(Config)
        listen()
        if (obj.success) obj.success();
        // refreshMenu()
    }

    // 刷新菜单
    function refreshMenu(){
       setTopMenu()
    }

    function open_window(_url,_area,_success){
        var _area=_area||['500px', '300px']
        layer.open({
            type: 1,
            title:false,
            offset: 'rb', //右下角弹出
            closeBtn: 0, //不显示关闭按钮
            anim: 2,
            area: _area,
            shade:false,
            content: _url,
            success:_success
        });
    }

    function alayer(_obj){
        // _obj.area=_obj.area||(isMobile()?['90%','300px']:['500px', '300px']);
        if(_obj.area){
           _obj.area=[isMobile()?'90%':'500px',_obj.area.indexOf(1)?_obj.area[1]:'300px']
        }else{
           _obj.area=(isMobile()?['90%','300px']:['500px', '300px'])
        }
        // layer.open({
        //     type: 1,
        //     title:false,
        //     offset: 'rb', //右下角弹出
        //     closeBtn: 0, //不显示关闭按钮
        //     anim: 2,
        //     area: _obj.area,
        //     shade:false,
        //     content: _obj.content,
        //     success:_success
        // });
        return layer.open(_obj);
    }

    /**
     * 运行模板，如果开启缓存（默认），第一次采取下载，再次使用将读取缓存
     * @param  {[type]} _name  [description]
     * @param  {[type]} _arg   [description]
     * @param  {[type]} _cache 是否缓存
     * @return {[type]}        [description]
     */
    function runTpl(_name,_arg,_cache){
        var elem = 'body #template-content';
        var path_full_name = _name;
        _name = _name.replace('/','_');
        var last_name = path_full_name.split('/')[path_full_name.split('/').length - 1];

        // console.log('使用模板', _name, path_full_name)
        if(_cache==undefined){
            _cache=true
            if ($(elem).length == 0){
                // 自动增加缓存标签
                $('body').append('<div id="template-content" style="display:none;"></div>')
            }
        }else{
            _cache=false
        }

        if(_cache==true && $('#tpl-'+_name).length>=1){
            // console.log('使用缓存模板')
            // 模板存在
            if (oTpl[_name]) {
                oTpl[_name](_arg);
                return;
            }
            if (oTpl[last_name]) {
                oTpl[last_name](_arg);
                return;
            }
            console.error('"' + _name + '","' + last_name + '"模板未定义')

        }else{
            // console.log('下载使用模板')
            // 防止叠加，删除上次缓存
            $(elem+' #template-content-'+_name).remove()
            ajaxGet(Config.templatePath + path_full_name+'.html',function(html){
                $(elem).append('<div id="template-content-'+_name+'">'+html+'</div>');
                if (oTpl[_name]) {
                    oTpl[_name](_arg);
                    return;
                }
                if (oTpl[last_name]) {
                    oTpl[last_name](_arg);
                    return;
                }
                console.error('"' + _name + '","' + last_name + '"模板未定义')
                
            })
        }
    }


    function defTpl(_name,_func){
        oTpl[_name]=_func
    }

    // 是否为手机访问
    function isMobile() {
        var userAgentInfo = navigator.userAgent;
        var mobileAgents = [ "Android", "iPhone", "SymbianOS", "Windows Phone", "iPad","iPod"];
        var mobile_flag = false;

        //根据userAgent判断是否是手机
        for (var v = 0; v < mobileAgents.length; v++) {
            if (userAgentInfo.indexOf(mobileAgents[v]) > 0) {
                mobile_flag = true;
                break;
            }
        }

         var screen_width = window.screen.width;
         var screen_height = window.screen.height;    

         //根据屏幕分辨率判断是否是手机
         if(screen_width < 500 && screen_height < 800){
             mobile_flag = true;
         }

         return mobile_flag;
    }

    // 清空缓存和事件
    function cleanPage(){
        events = {};
        pageCacheC={};
    }

    function loadPage(){
        // 页面关闭事件
        if (events.pageClose){
            if(events.pageClose()===false){
                return;
            }
        }
        cleanPage();// 清空缓存和事件
        var url="";
        if (Config.viewUrlApi){
            // 指定页面获取url
            ajaxPost(Config.viewUrlApi, {'p': Config.viewUrlPrefix + getRoute()}, function (html) {
                eContent.html(html);
                eContent.attr('path', parseUrl(getRoute()).path);
            }, function (e) {
                eContent.html('页面错误，请稍后重试');
            })
        }else{
            url = Config.viewUrlPrefix + getRoute();
            // console.log(url);
            // 自动加后缀
            let urlObj = parseUrl(url)
            url = urlObj.relative;
            let start = url.indexOf("?")
            if (start != -1) {
                url = url.slice(0, start) + ".html" + url.slice(start)
            } else {
                url = url + ".html"
            }
            let templateUrl =url;
            ajaxGet(templateUrl, function (html) {
                eContent.html(html);
                eContent.attr('path', parseUrl(getRoute()).path);
            }, function (e) {
                eContent.html('页面错误，请稍后重试');
            })
        }
    }

    // 获取子页路径
    function getContentPagePath(){
        return eContent.attr('path');
    }
    


    function listen(){
        $(window).bind('hashchange', function(e) {
            // console.log("地址栏变化");
            route.new=getRoute();
            if (events['routeChange']){
                if (events.routeChange(route.new.split("?")[0], route.old.split("?")[0])!==false){
                    loadPage();
                }
            }else{
                loadPage();
            }
        });
    }

    function getToken() {
        return layui.data('userInfo').token;
    }

    // 注册事件
    function register(name,callback){
        events[name] = callback;
        // console.log('注册事件', name);
    }

    // ==================
    // 组件相关
    // ==================

    // 组件
    function component(_name, callback){
        if (!callback){
            defComponent(_name, callback);
        }else{
            useComponent(_name);
        }
    }

    // 定义组件
    function defComponent(_name, callback) {
        
    }

    // 使用组件
    function useComponent(_name){

    }

    // ==================
    // 组件相关 end
    // ==================
    
    var app={
        // 属性
        cache: pageCacheC,
        // 方法
        init:init,
        ajaxGet:ajaxGet,
        parseUrl:parseUrl,
        // getUrl: getUrl,// 暂时不用，被route...替代
        getRoute: getRoute,
        go:go,
        // setUrl: setUrl,// 暂时不用，被route...替代
        setRoute: setUrl,
        open:open,
        ajaxPost:ajaxPost,
        // bytesToSize:bytesToSize,
        // setTopMenu:setTopMenu,
        // getExtendName:getExtendName,
        runTpl:runTpl,
        defTpl:defTpl,
        layer:alayer,
        isMobile:isMobile,
        // loadPage: loadPage,
        goToPage: goToPage,
        getToken: getToken,
        eventRegister: register,
        $e: events,
        events: events,
        hashChangeListen:function(path,callback){
            hashChangeListen[path]=callback;
        },
        getContentPagePath: getContentPagePath,//获得内容页地址，每次调用go goToPage 会更新，不会记录get参数
        pageCache:function(func_name,func) {
            pageCacheC[func_name] = func
        },
        usePageCache: function (func_name) {
            return pageCacheC[func_name]
        }
    }
    exports('app', app);
});    


