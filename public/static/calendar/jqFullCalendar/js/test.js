// timelineYear
layui.use(['layer','laydate','form','colorpicker','jquery'],function(){
            var layer=layui.layer,laydate=layui.laydate,colorpicker=layui.colorpicker,form=layui.form;
            // $=jQuery=layui.jquery;
            var calendar=null;
            var get = moment().format('YYYY-MM-DD');
            var config=null;
            var obj_id=1;
            post('/calendar/objectapi/getConfig?obj_id='+obj_id,[],function(res){
                config=res.data;
                render(res.data)
            })
            
            function render(config){
                var config=config||{};
                calendar = $('#calendar').fullCalendar({
                    // 自定义按钮
                    customButtons: {
                        setting: {
                            text: '设置',
                            click: function() {
                                console.log('设置按钮');
                                layer.open({
                                    type: 2,
                                    title: '设置项目',
                                    shadeClose: true,
                                    shade: false,
                                    maxmin: true, //开启最大化最小化按钮
                                    area: ['500px', '600px'],
                                    content: "/calendar/object/set?obj_id={:input('get.obj_id')}"
                                });
                                // location.href="/calendar/object/set?obj_id={:input('get.obj_id')}";
                            }
                        },
                        list: {
                            text: '返回列表',
                            click: function() {
                                var last_url=document.referrer;
                                var res=last_url.search(/calendar/i)
                                // 如果上一页不是项目列表，则跳转，如果是则返回
                                if(res==-1){
                                    location.href="/calendar";
                                }else{
                                    window.history.back(-1); 
                                }
                            }
                        }
                    },
                    // 设置日历头部信息，false，则不显示头部信息。包括left，center,right左中右三个位置
                    header: {
                        left: 'list,setting,basicWeek,basicDay',                               //上一个、下一个、今天
                        center: 'title',                                        //标题
                        right: 'prev,next,today, month,agendaWeek,agendaDay,listMonth'           //月、周、日、日程列表
                    },
                    //语言
                    locale: 'zh-cn',
                    //日程事件的时间格式
                    timeFormat: 'HH:mm',
                    //各按钮的显示文本信息
                    buttonText: {     
                        today: '今天',
                        month: '月',
                        agendaWeek: '周',
                        agendaDay: '日',
                        listMonth: '日程',
                    },
                    //true:固定显示6周，false:根据实际情况4 5 6周
                    fixedWeekCount:false,
                    // 月份全称
                    monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],        
                    // 月份简写
                    monthNamesShort: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"], 
                    // 周全称
                    dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],       
                    // 周简写
                    dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],  
                    // listview视图下，无数据提示
                    noEventsMessage : "当月无数据",                              
                    // 自定义全天视图的名称 
                    allDayText: "全天",                                           
                    // 是否在周日历上方显示全天
                    allDaySlot: false,                                          
                    // 是否为全天日程事件，显示这一天中所做的事情
                    // allDayDefault: false,
                    // 一格时间槽代表多长时间，默认00:30:00（30分钟）
                    slotDuration : "00:30:00",
                    // 日期视图左边那一列显示的每一格日期时间格式
                    slotLabelFormat : "H(:mm)a",
                    // 日期视图左边那一列多长间隔显示一条日期文字(默认跟着slotDuration走的，可自定义)
                    slotLabelInterval : "01:00:00",
                    // 其实就是动态创建一个日程时，默认创建多长的时间块
                    snapDuration : "01:00:00",
                    // 所有视图显示时间
                    displayEventTime:(Number(config.c_dayTimeDisplay)==0?false:true),
                    // 所有视图显示结束时间
                    displayEventEnd: (Number(config.c_dayTimeDisplay)==2?true:false),
                    // 一周中显示的第一天是哪天，周日是0，周一是1，类推
                    firstDay: (Number(config.firstDay)?1:0),
                    // 隐藏一周中的某一天或某几天，数组形式，如隐藏周二和周五：[2,5]，默认不隐藏，除非weekends设置为false。
                    // hiddenDays: [],
                    // 是否显示周六和周日，设为false则不显示周六和周日。默认值为true
                    // weekends: true,
                    // 是否在日历中显示周次(一年中的第几周)，如果设置为true，则会在月视图的左侧、周视图和日视图的左上角显示周数。
                    weekNumbers: Number(config.weekNumbers),
                    // 周次的显示格式。
                    weekNumberCalculation: 'iso',
                    // 设置日历的高度，包括header日历头部，默认未设置，高度根据aspectRatio值自适应。
                    height: $(window).height()-125,                                               
                    // 设置日历主体内容的高度，不包括header部分，默认未设置，高度根据aspectRatio值自适应。
                    // contentHeight: 'auto',                                        
                    // 是否随浏览器窗口大小变化而自动变化。
                    handleWindowResize: true,                                   
                    // 初始化时默认视图，默认是月month，agendaWeek是周，agendaDay是当天
                    defaultView: 'month',                                       
                    // 事件是否可以重叠覆盖
                    // slotEventOverlap: true,                                    
                    // 默认显示那一天的日期视图getDates(true)2020-05-10
                    defaultDate: get,                                          
                    // 周/日视图中显示今天当前时间点（以红线标记），默认false不显示
                    nowIndicator: true,                                         
                    // 数据条数太多时，限制显示条数，默认false不限制,支持输入数字设定固定的显示条数，true超出高度自动
                    eventLimit: Number(config.eventLimit),                                          
                    // 当一块区域内容太多以"+2 more"格式显示时，这个more的名称自定义（应该与eventLimit: true一并用）
                    eventLimitText: "点击查看更多",                                       
                    // 点开"+2 more"弹出的小窗口标题，与eventLimitClick可以结合用
                    dayPopoverFormat : "YYYY年M月D日",                             
                    // method,绑定日历到id上。$('#id').fullCalendar('render');
                    render:function(view){                                      
                        console.log('render','渲染',view)
                    },
                    events: function(start, end, timezone, callback){   
                        console.log('获取数据');
                        var start =moment(start).utc().format('YYYY-MM-DD HH:mm:ss')
                        var end =moment(end).utc().format('YYYY-MM-DD HH:mm:ss')
                        // console.log(start,end, timezone);
                        var postdata={}
                        postdata['start_time']=start;
                        postdata['end_time']=end;
                        post('/calendar/eventapi/getList?obj_id='+obj_id,postdata,function(data){
                            console.log(data);
                            // for (var i = 0; i < data.length; i++) {
                            //     data[i]['allday']=1;
                            // }
                            callback(data);
                            // if (data != null && data.length > 0) {
                            //     for(var i= 0; i < data.length; i ++) {
                            //             //状态判断？？？
                            //             //颜色区分？？？
                            //     }
                            // }
                        })
                    },
                    dayClick: function(date, allDay, jsEvent, view) {                       
                        //空白的日期区点击
                        console.log('点击日期空白处');
                        // alert($.fullCalendar.formatDate(date, "YYYY-MM-DD"));
                        // console.log('Clicked on: ' + date.format());
                        // return false;
                    },
                    eventClick: function(event, jsEvent) {                                  
                        //点击已有日程事件
                        console.log(event);

                        var data={};         
                        data['start']=event.start.format("YYYY-MM-DD HH:mm:ss");
                        data['end']=event.end.format("YYYY-MM-DD HH:mm:ss");
                        data['title']=event.title;
                        data['color']=event.color;
                        data['className']=event.className[0];
                        data['content']=event.content;
                        console.log(data);
                        // moment().format('YYYY-MM-DD HH:mm:ss'); // "2020-07-30 21:11:01"
                        openInfo(data,event);
                    },
                    //是否允许通过单击或拖动选择日历中的对象，包括天和时间
                    selectable: true,                                   
                    //当点击或拖动选择时间时，是否预先画出“日程区块”的样式显示默认加载的提示信息，该属性只在周/天视图里可用
                    selectHelper: true,                                 
                    //是否允许选择被事件占用的时间段，默认true可占用时间段
                    selectOverlap : true,                               
                    selectAllow : function(selectInfo){
                        console.log('选择数据');
                        // 精确的控制可以选择的地方，返回true则表示可选择，false表示不可选择
                        // console.log("start:"+selectInfo.start.format()+"|end:"+selectInfo.end.format()+"|resourceId:"+selectInfo.resourceId);
                        if(Number(config.c_onlyRead)){
                            return false;
                        }else{
                            return true;
                        }
                    },
                    select: function(start, end, allDay) {  
                        // $("#calendar").fullCalendar('renderEvent',true); 
                        console.log(start,end,allDay);   
                        return;
                        var data={};         
                        data['start']=moment(start).utc().format('YYYY-MM-DD HH:mm:ss');
                        data['end']=moment(end).utc().format('YYYY-MM-DD HH:mm:ss');
                        // moment().format('YYYY-MM-DD HH:mm:ss'); // "2020-07-30 21:11:01"
                        openInfo(data);
                    },
                    // 是否启用懒加载技术--即只取当前条件下的视图数据，其它数据在切换时触发，默认true只取当前视图的，false是取全视图的
                    lazyFetching : true,                                    
                    // 在Event Object中如果没有end参数时使用，如start=7:00pm，则该日程对象时间范围就是7:00~9:00
                    defaultTimedEventDuration : "02:00:00",                
                    //默认1天是多长，（有的是采用工作时间模式，所以支持自定义）
                    defaultAllDayEventDuration : { days: 1 },               
                    // loading: function(isLoading, view) {
                    // },
                    // 支持日程拖动修改，默认false
                    editable: (Number(config.c_onlyRead)?0:1),                                         
                    dragOpacity:0.2,                                        //拖拽时不透明度，0.0~1.0之间，数字越小越透明
                    dragScroll : true,                                      //是否在拖拽时自动移动容器，默认true
                    eventOverlap : true,                                    //拖拽时是否重叠
                    eventConstraint : {                                     //限制拖拽拖放的位置（即限制有些地方拖不进去）t
                     // start: '10:00',                                     //开始时间10点
                     // end: '18:00',                                       //结束时间18点
                        dow: [ 1, 2, 3, 4, 5, 6, 0 ]                        //0是周日，1是周一，以此类推
                    },
                    longPressDelay : 1000,                                  //移动设备，长按多少毫秒即可拖动,默认1000毫秒（1S）
                    eventDrop : function(event, dayDelta, delta, revertFunc, jsEvent, ui, view){  
                        //日程拖拽停止，并且时间改变时触发，ayDelta日程前后移动了多少天
                        var data={};         
                        data['startTime']=event.start.format("YYYY-MM-DD HH:mm:ss");
                        data['endTime']=event.end.format("YYYY-MM-DD HH:mm:ss");
                        data['title']=event.title;
                        data['color']=event.color;
                        data['className']=event.className[0];
                        data['event_id']=event.event_id;
                        data['content']=event.content;
                        post('/calendar/eventapi/update?obj_id='+obj_id,data,function(res){
                            console.log(res);
                        })
                    }
                });

                
            }

            // 打开详情窗口
            function openInfo(data,event){
                var title=data.title||'';
                var color=data.color||'';
                if(!Number(config.c_onlyRead)){
                    var layeropentitle=(event?'修改事件':'新增事件');
                }else{
                    var layeropentitle='详情';
                }
                layer.open({
                        type: 1,
                        shade: 0.5,
                        title: layeropentitle,
                        content: $('#form_input').html(),
                        success:function(){
                            // 如果只读模式需要删除不需要的元素
                            if(Number(config.c_onlyRead)){
                                $('#class_select').parents('.layui-form-item').remove();
                                $('#color_input').parents('.layui-form-item').remove();
                                $('#submit').parents('.layui-form-item').remove();
                                $('#text_input').attr('readonly','');
                                $('#content').attr('readonly','');

                            }else{
                                laydate.render({
                                    elem: '#start_time'
                                    ,type: 'datetime'
                                });
                                laydate.render({
                                    elem: '#end_time'
                                    ,type: 'datetime'
                                });
                            }
                            // 获取风格列表
                            post('/calendar/style/getStyleList','',function(res){
                                if(res.code==1){
                                    for (var i = 0; i < res.data.length; i++) {
                                        $('#class_select').append('<option value="'+res.data[i]['name']+'">'+res.data[i]['name_cn']+'</option>')
                                    }
                                    
                                    $('#start_time').val(data.start)
                                    $('#end_time').val(data.end)
                                    $('#color_input').val(color);
                                    $('#text_input').val(title);
                                    $('#class_select').val(data['className']);
                                    $('#content').val(data['content']);
                                    form.render()
                                }
                            })
                            

                            

                            colorpicker.render({
                                elem: '#test-form'
                                ,color: color
                                ,done: function(color){
                                    $('#color_input').val(color);
                                }
                            });
                            if(!event || !event.event_id){
                                $("#delete").remove();
                            }
                            
                            // 删除事件
                            $('#delete').click(function(){
                                var postdata={};
                                layer.confirm('确定删除此日程吗', {
                                    btn: ['确定','取消'] //按钮
                                }, function(){
                                    postdata["event_id"]=event.event_id;
                                    post('/calendar/eventapi/delete?obj_id='+obj_id,postdata,function(res){
                                        if(res.code==1){

                                            layer.closeAll();
                                            // location.href="?obj_id={:input('get.obj_id')}&date="   
                                            calendar.fullCalendar('refetchEvents');

                                        }else{
                                            layer.msg('删除失败')
                                        }
                                    })
                                })
                                
                            })
                            // 监听保存
                            $('#submit').click(function(){
                                var d={       
                                    //一旦日历重新取得日程源，则原有日程将消失，当指定stick为true时，日程将永久的保存到日历上
                                    title: $('#text_input').val(),
                                    start: $('#start_time').val(),
                                    end: $('#end_time').val(),
                                    content:$('#content').val(),
                                    allDay: data.allDay,
                                    // rendering: 'background',
                                    block: true,
                                    className:$('#class_select').val(),
                                    color:$('#color_input').val(),
                                }
                                
                                if(d.title==''){
                                    layer.msg('请填写标题')
                                    return;
                                }
                                    
                                var postdata={};
                                if(event){
                                    d['source']=event.source
                                }
                                postdata['startTime'] =d.start;
                                postdata['endTime'] =d.end;
                                postdata['title'] =d.title;
                                postdata['className'] =d.className;
                                postdata['color'] =d.color;
                                postdata['content'] =d.content;
                                if(event && event.event_id){
                                    postdata['event_id'] =event.event_id;
                                    post('/calendar/eventapi/update?obj_id='+obj_id,postdata,function(res){
                                        if(res.code==1){
                                            // calendar.fullCalendar('renderEvent',d,false);
                                            calendar.fullCalendar('refetchEvents');
                                            layer.closeAll();
                                        }else{
                                            layer.msg('修改失败')
                                        }
                                    })
                                }else{
                                    
                                    post('/calendar/eventapi/add?obj_id='+obj_id,postdata,function(res){
                                        if(res.code==1){
                                            d['event_id']=res.event_id;
                                            calendar.fullCalendar('renderEvent',d,false);
                                            layer.closeAll();
                                        }else{
                                            layer.msg('添加失败')
                                        }
                                    })
                                }
                                

                                
                            })

                        }
                    });


            }

            function setOption(k,v){
                calendar.fullCalendar('option', k, v);// 动态设置参数
            }

            $('#test-btn').click(function(){
                    console.log('安妮');
                    setOption('firstDay',1);
                    // render()
                    // calendar.fullCalendar('refetchEvents');// 刷新数据
                    // $('#calendar').fullCalendar('option', 'firstDay', 1);// 动态设置参数
                    // $('#calendar').fullCalendar('render'); // 重新渲染
                    // calendar.getTopLevelResources()
            })
            function post(url,data,callback){  
                 $.ajax({
                    type : "post",
                    url : url,
                    dateType:'json',
                    data:data,
                    success : function(res) {
                        callback(res);
                    }
                 });
            }
        });
