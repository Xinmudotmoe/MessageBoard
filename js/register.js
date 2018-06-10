var $$$=false;
function register() {
    if ($$$){return}
    $('#tr').css('display','block');
    $$$=true;
    var name,pass,mail,sax;
    var c=$(".asm input");
    for (let a = 0; a<3; a++){
        let b = c[a].value;
        switch (a){
            case 0:
                name=b;
                break;
            case 1:
                pass=b;
                break;
            case 2:
                mail=b;
        }
    }
    sax=$("#myonoffswitch").val();
    setTimeout(()=>{
        if(name[0]in [...Array(10).keys()])
            alert("含有非法数据，请求被拒绝。");
        else
        $.post("api/register.php",{ASS:0,name:name,pass:pass,mail:mail,sax:sax},function (data) {
            let pd=JSON.parse(data);
            switch (pd["code"]){
                case 0:
                    alert("注册成功，您可以使用用户名:"+name+"，或唯一识别号:"+pd["id"]+"来登陆本系统。");
                    break;
                case -1:
                    alert("输入值不完整。");
                    break;
                case -2:
                    alert("含有非法数据，请求被拒绝。");
                    break;
                case -3:
                    alert("存在同名用户，请修改您的用户名。");
                    break;
            }
            $("#tr").css('display','none');
            $$$=false;
        })
    },3000);

}
$(document).ready(function () {
    let t=$("#myonoffswitch");
    t.val(1);
    t.on('click', function(){
        t.val(!t.val()==1);//看似语法歧义 实则稳如老狗
    });
});