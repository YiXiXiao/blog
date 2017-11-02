<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"/Users/hxfy/Documents/phpWorkSpace/blog/public/../application/admin/view/login/index.html";i:1489992446;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理登陆 - <?php echo \think\Config::get('auth.blogname'); ?></title>
    <link rel="stylesheet" href="admin_css/style.css"/>
    <script src="home_js/jquery-1.10.1.min.js"></script>
    <script src="com_layer/layer.js"></script>
</head>
<body class="login-bg" data-url="<?php echo url('Base/login'); ?>" data-tip="<?php echo isset($tip) ? $tip : 0; ?>">
    <div class="login-nav"></div>
    <script>
        $(document).ready(function () {
            _this = $('.login-bg');
            var tip = _this.data('tip');
            var url = _this.data('url');
            if(tip == 0) {
                qqlogin(url);
            }else if(tip == 1){
                layer.msg('该账号不是管理员!',{area: '200px',shift:6},function(){
                    qqlogin(url);
                });
            }
        });
        // === QQ登陆 === //
        function qqlogin(url){
            layer.open({
                type: 2,
                id: 'qqlogin',
                title: false,
                shadeClose: false,
                closeBtn: 0,
                shade: false,
                area: ['500px', '400px'],
                content: [url, 'no']
            });
        }
    </script>
</body>
</html>
