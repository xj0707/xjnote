<?php

/* @var $this yii\web\View */

$this->title = 'NA';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>欢迎你!</h1>

        <p class="lead">点击登录可以进入后台管理</p>

        <p><a class="btn btn-lg btn-success"  href="#" id="btn11">加入我们</a></p>
        <p><a class="btn btn-lg btn-success"  href="#" target="_blank" id="message3"></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>推锅</h2>

                <p>麻将的牌九，就是俗称的推锅。古老的中国博弈游戏。起源于宋代。与牌九扑克很相似，只有32只骨牌。在中国的古代帝制里，
                    宫员主要分为文、武两类。 而天九牌亦是主要分为文子及武子。 天九早在宋朝已有记载，当时称为牙牌或骨牌。牌九是中国
                    古代传统的游戏，主要是依据骨牌点数的不同组合来比牌的大小，并以此决出胜负。通常用于赌博。最大的牌为「至尊宝」，
                    由「二四」与「么二」组成，其馀依次为「天牌」、「地牌」、「人牌」、「和牌」、「梅花」、「长三」、「长二」、「虎头」
                    等对子，馀下来的是不能组成对的杂牌，杂牌中也有大小。</p>

                <p><a class="btn btn-default" href="#">申请开通 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>推筒子</h2>

                <p>二八杠游戏，又称疯狂牌九，是利用中国传统游戏麻将中单一色筒子牌（一筒到九筒，每一种花色 4 张牌，一共 36 张牌），
                    外加白板 4 张牌共计 40 张牌，所发展出的一个博奕游戏。二八杠（28杠）又称推筒子是采用三十六张数字牌来比较大小，
                    这是一种考胆略和智慧的扑克游戏，玩二八杠除了一定的运气之外，牌技占了输赢因素的百分之八十，所以拥有一手好的牌技
                    就能让你在二八杠的牌场上事半功倍</p>

                <p><a class="btn btn-default" href="#">申请开通 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>麻将</h2>

                <p>麻将，起源于中国，粤港澳地区俗称「麻雀」，由中国古人发明的博弈游戏，娱乐用具，一般用竹子、骨头或塑料制成的小长方块，
                    上面刻有花纹或字样，每副136张。四人骨牌博戏，流行于华人文化圈中。麻将是一种中国古人发明的博弈游戏，牌类娱乐用具，
                    用竹子、骨头或塑料制成的小长方块,上面刻有花纹或字样，每副136张（有的地区74张）。不同地区的游戏规则稍有不同。
                    麻将的牌式主要有“饼（文钱）”、“条（索子）”、“万（万贯）”等。在古代，麻将大都是以骨面竹背做成，可以说麻将牌实际上
                    是一种纸牌与骨牌的结合体。与其他骨牌形式相比，麻将的玩法最为复杂有趣，它的基本打法简单，容易上手，但其中变化又极多，
                    搭配组合因人而异，因此成为中国历史上一种最能吸引人的博戏形式之一。</p>

                <p><a class="btn btn-default" href="#">申请开通 &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
</script>
<script>
    $(document).ready(function(){
        $("#btn11").on("click",function(){
            //向服务器发送请求(get、post)
            $.post("<?php echo \yii\helpers\Url::toRoute(['site/yy'])?>",
                {
                    username:1,
                    merchantId:2
                },
                function(str){

                    var data = JSON.parse(str);
                    console.log(data);
                    if(data.code==1){
                        $("#message3").attr('href',data.url);
                        $("#message3").text('后台链接');
                    }else{
                        $("#message3").text(data.message);
                    }
                });
        })
    })

</script>