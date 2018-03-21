
window.onload=function(){
    $("#lgname").focus();
    $("#lgname").keydown(function(event){
        if(event.keyCode==13){
            $("#lgpwd").focus();
        }
    });
    $("#lgpwd").keydown(function(event){
        if(event.keyCode==13){
            $("#lgchk").focus();
        }
    });
    $("#lgchk").keydown(function(event){
        if(event.keyCode==13){
            chklg();
        }
    });
    $("#lgbtn").click(function(){
        var lgname=$("#lgname").val();
        var lgpwd=$("#lgpwd").val();
        var lgchk=$("#lgchk").val();
        //if(lgchk){
        //    $.post('verifycode.php',{chk:lgchk},function(result){
        //        var jsonarray= $.parseJSON(result);
        //        if(jsonarray.code!=1){
        //            alert('验证码错误1');
        //            return false;
        //        }
        //    });
        //}
        if(lgname && lgpwd && lgchk){
            $.post('login_chk.php',{name:lgname,pwd:lgpwd,chk:lgchk},function(result){
                if(result==1){
                    window.location.href="index.php";
                }else if(result==2){
                    alert('请填写完整参数');
                }else if(result==3){
                    alert('验证码不正确');
                }else if(result==4){
                    alert('用户名或者密码错误');
                }else if(result==5){
                    alert('账号还没有激活');
                }else if(result==6){
                    alert('登陆失败，请重试');
                }else{
                    alert('登陆失败，请重试');
                }
            });
        }else{
            alert('请输入完整信息');
        }

    });

    function chklg(){
        var lgname=$("#lgname").val();
        var lgpwd=$("#lgpwd").val();
        var lgchk=$("#lgchk").val();
        reg=/^[a-zA-Z_]{1}/;
        if(!reg.test(lgname)){
            alert('请输入合法的名称');
            $("#lgname").focus();
            return false;
        }
        if(lgpwd==''){
            alert('请输入密码');
            $("#lgpwd").focus();
            return false;
        }
        if(lgchk==''){
            alert('请输入验证码');
            $("#lgchk").focus();
            return false;
        }else{
            $.post('verifycode.php',{chk:lgchk},function(result){
                var jsonarray= $.parseJSON(result);
                if(jsonarray.code!=1){
                    alert('验证码错误');
                    $("#lgchk").focus();
                    return false;
                }
            });
        }
        //count=document.cookie.split(';')[0];
        //if(count.split('=')[1]>=3){
        //    alert('因为你非法操作3次，你将无法登陆！');
        //    return false;
        //}


    }

    $("#imghandle").click(function(){
        $("#imghandle").attr('src','../../ImageHandle/VerifyImage.class.php?rand='+Math.random())
    });

    $("#reg").click(function(){
        window.location.href='register.html';
    });




}