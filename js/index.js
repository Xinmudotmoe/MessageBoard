var dataa=[];
var users=[];
var tusers=[];

var mydata;
let send_ret_map={"-1":"缺失数据，请通知管理员修复此错误。",
                  "-2":"数据非法",
                  "-3":"密钥无效，请重新登陆",
                  "-4":"密钥已过期，请重新登陆",
                  "-5":"未找到此楼层",
                  "-6":"无权删除",
                  "1":"成功"
};
function encodeStr(s){
    let val=[];
    for(var ass in s)
        val.push(s[ass].charCodeAt(0).toString(36));
    return val.join(".");
}
function decodeStr(s){
    let al = "";
    let arr = String(s).split(".");
    for (let ss in arr)
        al+=String.fromCharCode(parseInt(arr[ss],36));
    return al;
}
function addmessage(username,layer,date,message,candelect){
    var name=document.createElement("div");
    name.className="name";
    name.innerText="用户名：";
    var a=document.createElement("a");
    a.innerText=username;
    name.append(a);
    var datec=document.createElement("div");
    datec.className="date";
    datec.innerText=date;
    var command=document.createElement("div");
    if(!candelect)
        command.style["display"]='none';
    command.className="command";
    command.innerText="删除";
    command.id="layer_id_"+layer;
    var top=document.createElement("div");
    top.className="top";
    top.append(name);
    top.append(datec);
    top.append(command);
    var data=document.createElement("p");
    data.className="data";
    data.innerText=message;
    var messages=document.createElement("div");
    messages.className="message";
    messages.id="Layer_"+layer;
    messages.append(top);
    messages.append(data);
    $("#main").append(messages);
    $("#layer_id_"+layer).click(function(){
        remove(layer);
    });
}
function remove(layer){
    $.post("api/remove.php",{ass:132,pass:mydata["pass"],layer:layer},function (data) {
        alert(send_ret_map[data]);
    })
}
$.ajaxSetup({
    async : false
});

$("#main").ready(function () {
    let a=$.get("api/show.php",function(data){
        dataa=JSON.parse(data)
    });
    while (a.status!==200)
        $("#main").delay(100);
    a=$.get("api/get_all_userdata.php",function(data){
        users=JSON.parse(data);
        for (let i in users) {
            var t=users[i];
            tusers[t[0]]=t;
        }
    });
    while (a.status!==200)
        $("#main").delay(100);
    if($.cookie('Xinmu_User_Sign')){
        mydata=JSON.parse($.cookie('Xinmu_User_Sign'));
       $("#isin").css('display','block');
       $("#myname").text(users.filter(a=>a[0]==mydata["id"])[0][1]);
       $("#myname").css("display","block")
   }
   else
       mydata={id:-1};
   (function () {
       for (let _a in dataa){
           a=dataa[_a];
           try{
                addmessage(tusers[a[1]][1],a[0],new Date(parseInt(a[2])*1000).toLocaleString(),decodeStr(a[3]),a[1]===mydata["id"]||mydata["id"]==="0");
            }catch (e) {}
       }
   })();
});
function send() {
    if(mydata===null){
        alert("请登录");
        return
    }
    let datas=encodeStr($("#send .textarea textarea").val());
    $.get("api/send.php",{ass:0,pass:mydata["pass"],send:datas},function (d) {
        alert(send_ret_map[String(d)]);
    })
}