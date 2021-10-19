layui.config({base: '/static/layui/extends/',version: false})

layui.define(['core_build','core_base'],function(exports){ 
    var obj = {
        build:layui.core_build,
        base:layui.core_base
    };
    
    exports('core', obj);
});  