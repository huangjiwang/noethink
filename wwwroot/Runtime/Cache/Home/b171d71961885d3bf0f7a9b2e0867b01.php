<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>登录</title>
<link rel="stylesheet" type="text/css" href="public/Home/css/styles.css">
</head>
<body>
<div class="htmleaf-container">
	<div class="wrapper" style="height: 450px;">
		<div class="container">
			<h1>Welcome</h1>

			<form class="login-form" action="/index.php?s=/Home/User/login" method="post">
				<div class="control-group">
					<label class="control-label" for="inputEmail">用户名</label>
					<div class="controls">
						<input type="text" id="inputEmail" class="span3" placeholder="请输入用户名"  ajaxurl="/member/checkUserNameUnique.html" errormsg="请填写1-16位用户名" nullmsg="请填写用户名" datatype="*1-16" value="" name="username">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">密码</label>
					<div class="controls">
						<input type="password" id="inputPassword"  class="span3" placeholder="请输入密码"  errormsg="密码为6-20位" nullmsg="请填写密码" datatype="*6-20" name="password">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">验证码</label>
					<div class="controls">
						<input type="text" id="inputPassword" class="span3" placeholder="请输入验证码"  errormsg="请填写5位验证码" nullmsg="请填写验证码" datatype="*5-5" name="verify">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<img class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('verify');?>" style="cursor:pointer;height: 40px;">
					</div>
					<div class="controls Validform_checktip text-warning"></div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">登 陆</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

 
<block name="script">
	<script type="text/javascript">

		$(document)
				.ajaxStart(function(){
					$("button:submit").addClass("log-in").attr("disabled", true);
				})
				.ajaxStop(function(){
					$("button:submit").removeClass("log-in").attr("disabled", false);
				});


		$("form").submit(function(){
			var self = $(this);
			$.post(self.attr("action"), self.serialize(), success, "json");
			return false;

			function success(data){
				if(data.status){
					window.location.href = data.url;
				} else {
					self.find(".Validform_checktip").text(data.info);
					//刷新验证码
					$(".reloadverify").click();
				}
			}
		});

		$(function(){
			var verifyimg = $(".verifyimg").attr("src");
			$(".reloadverify").click(function(){
				if( verifyimg.indexOf('?')>0){
					$(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
				}else{
					$(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
				}
			});
		});
	</script>
<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';color:#000000">
<h1>数据管理系统</h1>
</div>
</body>
</html>