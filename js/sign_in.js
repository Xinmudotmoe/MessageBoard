var $$$=false;
function sign() {
    if ($$$){return}
    $('#tr').css('display','block');
    $$$=true;
    var name,pass;
    var c=$(".asm input");
    for (let a = 0; a<2; a++){
        let b = c[a].value;
        switch (a){
            case 0:
                name=b;
                break;
            case 1:
                pass=b;
        }
    }
    setTimeout(()=>{
            $.post("api/sign_in.php",{ass:0,sign:name,pass:pass},function (data) {
                switch (data){
                    case '-1':
                        alert("输入值不完整。");
                        break;
                    case '-2':
                        alert("含有非法数据，请求被拒绝。");
                        break;
                    case '-3':
                        alert("登陆失败");
                        break;
                    default:
                        $.cookie('Xinmu_User_Sign', data, { expires: 1, path: '/' });
                        alert("登陆成功");
                        break;
                }
                $("#tr").css('display','none');
                $$$=false;
            })
    },3000);
}