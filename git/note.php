<?php
//关于git 的一些用法
$str= <<<EOD
    1.通过git init 是这个目录变成git管理仓库（会有个.git的目录生成隐藏的 可以通过 ls -ah来看见）
    2.在这个目录下写自己的代码 通过 git add 文件名来添加到仓库里
    3.然后通过git commit -m '你的备注信息' 提交到仓库里
    4.git status 可以查看仓库当前的状态有没有准备提交的
    5.和远程github 或者 码云 进行ssh数据传输交流 先建立ssh key 命令如下 ssh-keygen -t rsa -C "799137494@qq.com"
    会生成一个公钥和私钥 然后把公钥里面的内容复制到添加公钥的地方
    6.现在 可以在远程的github 或者 码云 建立一个仓库 然后将本地的推送到这个仓库里面 做备份
    代码如下 git remote add origin git@git.oschina.net:xjgit1026/xiaojun.git;这就是关联操作
    7.关联后，使用命令 git push -u origin master 第一次推送master分支的所有内容，此后每次本地提交后，只要有必要就可以使用
    命令 git push origin master 推送最新修改（除了第一次要加-u 之外其他都不需要了）
    8.现在我们从零开发，最好的方式是先创建远程库，从远程库克隆命令如下 git clone git@........
EOD;
echo $str;