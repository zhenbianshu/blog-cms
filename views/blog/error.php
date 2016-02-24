<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$statusCode ?>状态页面-SQBlog</title>
<meta name="keywords" content="SQBlog">
<meta name="description" content="SQBlog <?=$statusCode ?>状态页面">
<meta name="author" content="SQBlog">
<style type="text/css">
body {margin:0;padding:0;font-size:14px;line-height:1.231;color:#555;text-align:center;font-family:"\5fae\8f6f\96c5\9ed1","\9ed1\4f53",tahoma,arial,sans-serif;}
a {color:#555;text-decoration:none;}
a:hover {color:orange;}
#container {width:684px;height:315px;margin:100px auto 0px auto;border:#999 solid 2px;background:url('/img/error.jpg');}
#container #title {overflow:hidden; padding-top:30px;}
#container #title h1 {font-size:36px;text-align:center;color:#222;}
#content p{ font-size:18px;}
#footer {width:100%;padding:20px 0px;font-size:16px;color:#555;text-align:center;}
</style>
</head>

<body>
<div id="container">
<div id="title"><h1>页面无法正常响应</h1></div>
<div id="content">
<p><a href="javascript:history.go(-1)" style="color:orange">尝试返回上一页</a></p>
<br />
<p style="font-size:24px;font-weight:bold;color:green">SQBlog <?=$statusCode ?>状态页面</p>
</div>
</div>
<div id="footer">©2015 <a href="http://alwayscoding.cn" target="_blank">SQBlog</a> All rights reserved.</div>
</body>
</html>