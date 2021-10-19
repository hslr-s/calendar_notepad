

layui.define(['jquery','layer'],function(exports){ 
    var $=layui.jquery,layer=layui.layer;
    var v_init=true;
    
    function requestPost(url,data,success,error){
        $.ajax({
            url:url,
            type:'post',
            data:data,
            success:function(res){
                if( typeof success =='function' && res.code==1){
                    success(res)
                }

                if( typeof error =='function' && res.code==0){
                    error(res)
                }else{
                    if(res.code==0){
                        layer.msg(res.errMsg);
                    }
                }
            }
        })
    }

    function setWindow(){
        var index = layer.load(1, {
          shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        
        $('.content-box').css('height',$(window).height()-115)
        $('.content').css('height',$(window).height()-115)
        if($(window).width()>600){
            $('.page').css('width',600)
            $('.page').css('margin','0 auto')
            $('.page').css('border','1px gray solid')
        }
        
        $('.page').removeClass('layui-hide');
        layer.close(index);
    }

    function init(){
        setWindow();
    }
    init();
    var obj = {
        requestPost:requestPost,
        init:function(arg){
            if(arg==false){
                return;
            }
            init()
        }
    };
  
    exports('core_base', obj);
});  