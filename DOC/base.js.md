### layer

```javascript
// 弹窗按钮
layerButtons=[
        {
            title: '保存',
            type:'primary',// warm,danger,primary
            onClick: function (layer_index) {
                
                return false;//阻止默认事件
            }
        },
    ];
app.base.layer({
    type: 1,
    shade: 0.5,
    skin:'content-info-layer',// 按钮有样式必须要定义skin
    title: "标题",
    content: $('#form_input').html(),
    buttons: layerButtons,
    success: function () {

    }
})                    
                       
```

### tplRender 模板渲染

```javascript
// elem 要读取的模板elem .class #id ...
// params 对象，模板参数，模板内读取：{{d.abc}},
// renderElem 目标elem,可空。填入将自动渲染
// callback(html) 回调，html:模板内容

// 自动渲染
app.base.tplRender('#tpl-file_tool_objlist',{}, '#target')

// 自行处理
app.base.tplRender('#tpl-event_info', {title:"我是标题"},null,function(html){
    // ....
})               
                       
```