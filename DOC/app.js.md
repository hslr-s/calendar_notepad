## 基础

### 全局事件

#### eventRegister 系统事件注册(页面销毁就销毁)

|名称|参数|说明|
|---|---|---|
|routeChange|function(new_route,old_route)|路由（地址）被改变|
|pageClose||页面关闭|

```
app.eventRegister('routeChange',func)
```

### 页面级别的系统事件

#### eventRegister 系统事件注册(页面销毁就销毁)

|名称|参数|说明|
|---|---|---|
|routeChange|function(new_route,old_route)|路由（地址）被改变|
|pageClose||页面关闭|

```
app.eventRegister('routeChange',func)
```

## 函数
### defTpl(tplName,callback(tplArg)) 定义模板

以下是一个最简单的模块（模板）设计元素

```html
<style>

</style>

<script type="text/html" id="tpl-TPLNAME">
  
</script>


<script>
    app.defTpl('TPLNAME', function (tplArg) {
      layui.use(['layer'],function(){

      });

    })
</script>
```

### runTpl(tplName,tplArg) 运行模板

```javascript
// 无参数
app.runTpl("defTpl")

// 有参数
app.runTpl("defTpl", {
    elem: "#list_box",
    onItemClick: function (item) {
        // 小于1000px将采用新窗口打开
        if($(window).width()<1000){
            // console.log('新创打开')
            app.go(app.base.route.fullContent+'?obj_id=' + item.obj_id)
        }else{
            // console.log('页内打开', app.parseUrl().path)
            app.go(app.parseUrl().path + '?obj_id=' + item.obj_id)
        }
    }
})                
```
