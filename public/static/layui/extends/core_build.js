
layui.define(['jquery'],function(exports){ 

    /**
     * 文件类型消息
     * @param  {[type]} con 示例：15|1寸.jpg
     * @return str
     */
    function file_message(con){
        var content=con.split("|")
        var url='/notebook/api/download/file_id/'+content[0]+'/'+content[1];
        con=`<a class="type-file" onclick='layui.cache.file_type("${url}")' data-id='${content[0]}' data-name="${content[1]}">[文件] ${content[1]} | ${getFileSize(content[2])}</a>`;
        // console.log(content[2],getFileSize(content[2]));
        // 如果图片类型显示图片
        var arr=content[1].split(".");
        if(layui.jquery.inArray(arr[arr.length-1],['jpg','png'])!=-1){
            con='<img src="'+url+'" style="width: 100%;height: 200px" alt="">'+con;
        }
        
        return con;
    }

    function getFileSize(fileByte) {
        var fileSizeByte = fileByte;
        var fileSizeMsg = "";
        if (fileSizeByte < 1048576) fileSizeMsg = (fileSizeByte / 1024).toFixed(2) + "KB";
        else if (fileSizeByte == 1048576) fileSizeMsg = "1MB";
        else if (fileSizeByte > 1048576 && fileSizeByte < 1073741824) fileSizeMsg = (fileSizeByte / (1024 * 1024)).toFixed(2) + "MB";
        else if (fileSizeByte > 1048576 && fileSizeByte == 1073741824) fileSizeMsg = "1GB";
        else if (fileSizeByte > 1073741824 && fileSizeByte < 1099511627776) fileSizeMsg = (fileSizeByte / (1024 * 1024 * 1024)).toFixed(2) + "GB";
        else if(!fileByte) fileSizeMsg = "--";
        else fileSizeMsg = "1TB+";
        return fileSizeMsg;
    }

    var obj = {
        fileMessage:file_message
    };
  
    exports('core_build', obj);
});  