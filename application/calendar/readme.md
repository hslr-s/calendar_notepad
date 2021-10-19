## Calendar [日历项目]

> 平时记事按天，可截图设定桌面打印等



### 注意事项




### 待开发功能

- 主题等设置
- 友好的加载图片
- 增加右键菜单删除等功能



### 文档

> js相关中文文档 https://www.helloweba.net/javascript/445.html

> 高级示例：http://www.bootstrapmb.com/item/2664/preview

> 官网：https://fullcalendar.io/docs#toc


#### 配置

> `c_`开头配置非合法的Calendar.js配置，需要二次判断等

```
firstDay:0                  //一周第一天0-6
weekNumbers: true,          //显示周次
eventLimit: 4,              //限制显示条数 
-- editable: false,            //拖动修改(合并到只读模式)
displayEventEnd: true,      //所有视图都显示时间

c_onlyRead:flase                    //阅读模式,不弹窗不得修改
```

#### 其他说明

更新节假日数据连接(两个参数可空)

【不可用】 http://tp51.cn/calendar/eventapi/buildHoliday?month=8&year=2020

http://tp51.enianteam.com/calendar/eventapi/buildHolidayNew?month=8&year=2021