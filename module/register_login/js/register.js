/**
 * 注册页面的js验证
 */

//加载页面是自动运行函数
window.onload=function(){
    $('#regname').focus();
    var cname1,cname2,cpwd1,cpwd2,cemail;
    //表单提交检查函数
    function chkreg(){
        //console.log(cname1,cname2,cpwd1,cpwd2,cemail);
        if(cname1=='yes' && cname2=='yes' && cpwd1=='yes' && cpwd2=='yes' && cemail=='yes'){
            $('#regbtn').attr('disabled',false);
        }else{
            $('#regbtn').attr('disabled',true);
        }
    }
//验证用户名
    $("#regname").keyup(function(){
        name=$("#regname").val();
        cname2='';
        reg=/^[a-zA-Z_]{1}/;
        if(!reg.test(name)){
            $("#namediv").html('<span style="color: red;">必须以字母或下划线开头</span>');
            cname1='';
        }else if(name.length <3 || name.length >20){
            $("#namediv").html('<span style="color: red;">名称长度必须在3到20之间</span>');
            cname1='';
        }else{
            $("#namediv").html('<span style="color: green;">名称合法</span>')
            cname1='yes';
        }
        chkreg();
    });
//当用户名失去了焦点时验证用户是否存在了 ajax
    $("#regname").blur(function(){
        name=$("#regname").val();
        if(name){
            if(cname1=='yes'){
                $.post("chkname.php",{name:name},function(result){
                    var jsonarray= $.parseJSON(result);
                    if(jsonarray.code==1){
                        cname2='yes';
                    }else if(jsonarray.code==2){
                        $("#namediv").html('<span style="color: red;">名称已经被占用了</span>');
                        cname2='';
                    }else{
                        $("#namediv").html('<span style="color: red;">'+jsonarray.message+'</span>');
                        cname2='';
                    }
                });
            }
        }
        chkreg();
    });
//验证密码
    $("#regpwd1").keyup(function(){
        regpwd1=$("#regpwd1").val();
        reg=/[a-zA-Z_0-9]+/;
        if(regpwd1.length<6 || regpwd1.length>30){
            $("#pwddiv1").html('<span style="color: red;">密码长度在6到30位之间</span>');
            cpwd1='';
        }else if(regpwd1.length<12){
            $("#pwddiv1").html('<span style="color: green;">密码强度弱</span>');
            cpwd1='yes';
        }else if(regpwd1.length<15 && reg.test(regpwd1)){
            $("#pwddiv1").html('<span style="color: green;">密码强度中</span>');
            cpwd1='yes';
        }else {
            $("#pwddiv1").html('<span style="color: green;">密码强度高</span>');
            cpwd1='yes';
        }
        chkreg();
    });
//验证两次密码是否一致
    $("#regpwd2").keyup(function(){
        regpwd1=$("#regpwd1").val();
        regpwd2=$("#regpwd2").val();
        if(regpwd1 != regpwd2){
            $("#pwddiv2").html('<span style="color: red;">两次密码不一致</span>');
            cpwd2='';
        }else if(regpwd2.length<6){
            $("#pwddiv2").html('<span style="color: red;">密码输入不正确</span>');
            cpwd2='';
        }else {
            $("#pwddiv2").html('<span style="color: green;">密码输入正确</span>');
            cpwd2='yes';
        }
        chkreg();
    });
//email验证
    $("#email").keyup(function(){
        email=$("#email").val();
        reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
        if(!reg.test(email)){
            $("#emaildiv").html('<span style="color: red;">请输入合法的邮箱</span>');
            cemail='';
        }else {
            $("#emaildiv").html('<span style="color: green;">邮箱正确</span>');
            cemail='yes';
        }
        chkreg();
    });
//添加更多信息按钮
    $("#but2").click(function(){
        mcss1=$("#morediv1").css('display');
        mcss2=$("#morediv2").css('display');
        if(mcss1=='none'){
            $("#morediv1").css('display','block');
            $("#morediv2").css('display','block');
            $("#but2").val('隐藏信息');
        }else{
            $("#morediv1").css('display','none');
            $("#morediv2").css('display','none');
            $("#but2").val('更多信息');
        }
    });
    //注册
    $("#regbtn").click(function () {
        $("#imgdiv").css('visibility','visible');
        $('#regbtn').attr('disabled',true);
        var username=$("#regname").val();
        var pwd1=$("#regpwd1").val();
        var pwd2=$("#regpwd2").val();
        var email=$("#email").val();
        var question=$("#question").val();
        var  answer=$("#answer").val();
        $.post("register.php",{name:username,pwd1:pwd1,pwd2:pwd2,email:email,question:question,answer:answer},function(result){
            $("#imgdiv").css('visibility','hidden');
            var jsonarray= $.parseJSON(result);
            if(jsonarray.code==1){
                $('#regbtn').attr('disabled',false);
               alert('注册成功！激活码已发送邮箱！！！');
               window.location.href='login.html';
            }else{
                $('#regbtn').attr('disabled',false);
                alert('注册失败，失败原因：'+jsonarray.message);
            }
        });
    });

}



























