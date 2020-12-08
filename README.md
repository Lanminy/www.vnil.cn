# Vnil视频/图集解析去水印接口文档

## Vnil(https://www.vnil.cn) 抖音、快手、小红书、微博、剪映、西瓜视频、火山小视频、今日头条、微视、美拍、皮皮虾、Tiktok、火锅视频、快影、快看点、趣头条、QQ看点、好看视频、阳光宽频网、绿洲、美图秀秀、皮皮搞笑、instagram、刷宝、全民小视频、最右、Youtube、Bilibili、轻视频、陌陌视频、开眼、UC浏览器、茄子短视频、淘宝、小咖秀、京东、天猫、VUE、一淘、新片场、场库、秒拍、巴塞电影、WIDE、拼多多、逗拍、Keep、比心、灵感、1688、唯品会等超过50个平台的去水印解析服务。
### 关于接口：

	1、接口采用RESTful API方式提供，不限制开发语言。当前文档中提供了PHP和Python两种语言的代码实例便于开发者方便接入。
		
	2、接口支持GET和POST两种参数提交方式
		
	3、接口错误码请参考“附录1：错误码说明”


### 一、视频/图集去水印解析接口
**URL：https://api.vnil.cn/api/parse/deal**  
**请求方式：GET/POST**  
**请求参数：**  

|字段|类型|必填|备注|赋值|
|---|---|---|---|---|  
| appkey | string | Y | 	appkey |www.vnil.cn开发者后台获取|
| url | string | Y | 要解析的资源地址信息 |例如：http://xhslink.com/f0aZc|

**返回结果：**  

**成功：**  

	{"code":0,"msg":"success","body":{"url":"http://xhslink.com/ELeLK","platform":"xiaohongshu","text":"【儿插数码班】\n👩🏼\u200d🎨12期正式课结束～特别喜欢室内这张示范！","images":["http://sns-img-qc.xhscdn.com/c8e4ac1a-12f9-3d7a-a253-eada3bbd8ef2?imageView2/2/h/1080/format.jpg","http://sns-img-qc.xhscdn.com/d5ead3b9-06a4-30ac-98bb-d3cefe863653?imageView2/2/w/1080/format.jpg","http://sns-img-qc.xhscdn.com/61ee711c-7395-3e53-8393-9c55fef5de37?imageView2/2/w/1080/format.jpg","http://sns-img-qc.xhscdn.com/22a01042-fa91-325c-b3be-045dd49612af?imageView2/2/h/1080/format.jpg","http://sns-img-qc.xhscdn.com/f1edf28c-cf0e-321f-8da0-411180cc8d00?imageView2/2/w/1080/format.jpg","http://sns-img-qc.xhscdn.com/7b714f0c-a5ca-3c8b-807a-720f41089821?imageView2/2/h/1080/format.jpg"],"video_info":[],"type":1,"cover":"http://sns-img-qc.xhscdn.com/c8e4ac1a-12f9-3d7a-a253-eada3bbd8ef2?imageView2/2/h/1080/format.jpg"}}
	
  
**失败：**	

	{"code":10001,"msg":"parameter lost","body":[]}

**返回字段注释** 

|字段名|注释|备注|
|---|---|---|
|code|错误码|错误码:请参考错误码说明|
|msg|错误信息|错误码:请参考错误码说明|
|body|||
|platform|所属平台|所属body，如：taobao、xiaohongshu|
|url|开发者请求的url|所属body|
|text|文案信息|所属body|
|cover|封面图地址|所属body|
|images|高清大图图片集合|所属body|
|video_info|视频信息|所属body，部分平台视频地址有有效期限制，不可作为永久存储|

PHP 实例代码：

	<?php
	//开发者后台生成的appkey
	$appkey = '';
		
	//需要解析的url
	$url = '';
	
	$param = [
		'appkey'	=> $appkey,
		'url'		=> $url,
	];
	
	//得到请求的地址：https://api.vnil.cn/api/parse/deal?appkey=appkey&url=url
	
	$apiUrl = 'https://api.vnil.cn/api/parse/deal?'.http_build_query($param);
	
	$ch = curl_init();
	curl_setopt ( $ch, CURLOPT_URL, $apiUrl );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt ( $ch, CURLOPT_MAXREDIRS, 5 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
	$content = curl_exec( $ch );
	curl_close ( $ch);
	
	print_r($content);

Python实例代码:

  
    #!/usr/bin/env python
    # encoding: utf-8

    import requests, urllib, json

    appkey = ""
    params = {
       "appkey": appkey,
       "url":"",
    }
	def get(url):
        params["url"] = url;
        api_url = "https://api.vnil.cn/api/parse/deal?" + urllib.parse.urlencode(params)

        msg = {"code": 0, "msg": "", "body": ""}

        response = requests.get(url=api_url, timeout=30)

        if response.status_code != 200:
		 	msg['code'] = 1
		 	msg["msg"] = "请求出现问题"
		 	return msg
	    # result = json.loads(response.text)      如果你直接拿到系统中使用请将返回参数直接转为json
	   	result = response.text  # 如果你不需要转换json，则直接接受数据并返回
	   	return result


	def post(url):
	    params["url"] = url
	    api_url = "https://api.vnil.cn/api/parse/deal"

	    msg = {"code": 0, "msg": "", "body": ""}

	    response = requests.post(url=api_url, data=params, timeout=30)
	    if response.status_code != 200:
		 	msg['code'] = 1
		  	msg["msg"] = "请求出现问题"
		  	return msg
	    # result = json.loads(response.text)      如果你直接拿到系统中使用请将返回参数直接转为json
	    result = response.text  # 如果你不需要转换json，则直接接受数据并返回
	    return result

	print(get("http://xhslink.com/f0aZc"))
	#print(post("http://xhslink.com/f0aZc"))

### 二. 获取作者信息接口：根据作者分享页url(目前支持抖音、快手、西瓜视频、微视、抖音火山版、美拍、火锅视频、好看视频、UC浏览器)
**请求地址：https://api.vnil.cn/api/batch/getAuthorInfo**  
**请求方式：GET/POST**  
**请求参数：**  

|字段|类型|必填|备注|赋值|
|---|---|---|---|---|  
| appkey | string | Y | appid |开发者后台生成的appkey |
| url | string | Y | 作者分享页url|

**返回结果：**  

**成功：**  

	{"code":0,"msg":"success","body":{"number":"kanzhengzhou","platform":"douyin","author":{"uid":"56009474501","name":"看郑州","number":"kanzhengzhou","avatar":"https://p6-dy-ipv6.byteimg.com/aweme/1080x1080/2f96500065722b0ab49e2.jpeg?from=4010531038","desc":"看郑州，观天下！","follower":360000,"focus":61}}}
	
  
**失败：**	

	{"code":10001,"msg":"parameter lost","body":[]}

**返回字段注释** 

|字段名|注释|备注|
|---|---|---|
|code|错误码|错误码:请参考错误码说明|
|msg|错误信息|错误码:请参考错误码说明|
|body|||
|uid|作者uid||
|name|昵称||
|number|抖音号||
|short_id|抖音内部短ID||
|avatar|头像|
|desc|简介||
|follower|粉丝数||
|focus|关注数||

PHP EXAMPLE：

PHP file\_get\_contents:
	
	//开发者后台生成的appkey
	$appkey = '';

	//需要解析的短视频平台作者分享页url
	$url= '';
	
	$param = [
		'appkey'		=> $appkey,
		'url'		=> $url,
	];
	
	//得到请求的地址：https://api.vnil.cn/api/batch/getAuthorInfo?appid=&appsecret=&url=
	$apiUrl = 'https://api.vnil.cn/api/batch/getAuthorInfo?'.http_build_query($param);
	$videoInfo = file_get_contents($apiUrl);
	print_r($videoInfo);


PHP curl为例：
	
	//开发者后台生成的appkey
	$appkey = '';
	
	//需要解析的短视频平台作者分享页url
	$url= '';
	
	$param = [
		'appkey'	=> $appkey,
		'url'		=> $url,
	];
	
	//得到请求的地址：https://api.vnil.cn/api/batch/getAuthorInfo?appid=&appsecret=&url=
	$apiUrl = 'https://api.vnil.cn/api/batch/getAuthorInfo?'.http_build_query($param);
	
	$ch = curl_init();
	curl_setopt ( $ch, CURLOPT_URL, $apiUrl );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt ( $ch, CURLOPT_MAXREDIRS, 5 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
	$content = curl_exec( $ch );
	curl_close ( $ch);
	
	print_r($content);


### 三. 获取作者作品列表(目前支持抖音、快手、西瓜视频、微视、抖音火山版、美拍、火锅视频、好看视频、UC浏览器)
**请求地址：https://api.vnil.cn/api/batch/getList**  
**请求方式：GET/POST**  
**请求参数：**  

|字段|类型|必填|备注|赋值|
|---|---|---|---|---|  
| appkey | string | Y | appkey |开发者后台生成的appkey |
| uid | string | Y | 作者uid(作者信息接口中返回) |
| platform | string | Y | 平台信息(作者信息接口中有返回) |
| cursor | string | N |上一次调用此接口中返回的"next_cursor"|

**返回结果：**  

**成功：**  

	{"code":0,"msg":"success","body":{"uid":"64269185197","platform":"douyin","page":{"current_cursor":"","next_cursor":1603971000000,"has_more":true},"list":[{"video_info":{"desc":"当志愿军老战士尝到现在的军粮……","url":"https://www.iesdouyin.com/share/video/6889282853125819656/","cover":"https://p9-dy.byteimg.com/img/tos-cn-p-0015/adfe2a8ade724922b8cbc1ff05552e68~c5_300x400.jpeg?from=2563711402_large"},"like_count":2167,"comment_count":26,"create_time":1604043633},{"video_info":{"desc":"遇难台军飞行员母亲控诉战机早有问题#台湾","url":"https://www.iesdouyin.com/share/video/6889289224672021767/","cover":"https://p6-dy-ipv6.byteimg.com/img/tos-cn-i-0813/188bbdf2fae44dc39a0dc57f0ce72ca3~tplv-dmt-logomcc:tos-cn-i-0813/4eec77d47e554bb0b2b6be3bcd5ce8b1:300:400.jpeg?from=2563711402_large"},"like_count":6593,"comment_count":46,"create_time":1604037677}]}}
	
  
**失败：**	

	{"code":10001,"msg":"parameter lost","body":[]}

**返回字段注释** 

|字段名|注释|备注|
|---|---|---|
|code|错误码|错误码:请参考错误码说明|
|msg|错误信息|错误码:请参考错误码说明|
|body|||
|desc|作品视频简介||
|url|视频网页地址||
| cover |作品视频封面||
| like_count |点赞数||
| comment_count |评论数||
| create_time |发布时间||
| next_cursor |翻页请求游标||
| has_more |是否有更多|true标识有更多，需要翻页请求，false标识无|

**接入注意点** 

	这里需要说明的是：
	1、返回的作品列表中视频url为有水印的视频网页访问地址，如需获取无水印的视频原始信息，请将当前获取的视频地址作为参数调用去水印解析接口
	2、当"page"下的"has_more"为"true"时，则表示下面还有内容，所需翻页获取，请将"next_cursor"作为参数"cursor",再次调用当前接口(获取作者作品列表)




### 四、获取开发者信息接口
**URL：https://api.vnil.cn/api/user/info**  
**请求方式：GET/POST**  
**请求参数：**  

|字段|类型|必填|备注|赋值|
|---|---|---|---|---| 
| appkey | string | Y | appkey |www.vnil.cn开发者后台获取|

**返回结果：**  

**成功：**  

	{"code":0,"msg":"success","body":{"times":995,"end_time":1597996121}}
	
**失败：**

{"code":10001,"msg":"parameter lost","body":[]}

返回字段注释

|字段名|注释|备注|
|---|---|---|
|code|错误码|错误码:请参考错误码说明|
|msg|错误信息|错误码:请参考错误码说明|
|body|||
|end_time|vip到期时间|所属body|
|times|剩余解析次数|所属body|

## 附录
### 1、错误码说明
|错误码|注释|
|---|---|
|code|错误码|
|0|解析成功|
|10001|请求参数缺失|
|10002|请求参数不合法|
|10003|开发者权限错误或开发者不存在|
|10004|签名校验失败|
|10005|请求接口的ip地址不在白名单或开发者没有设置ip白名单|
|10006|当前开发者不是vip或没有解析次数|
|10007|解析失败|
|10008|请求参数url地址不合法|
|10009|请求受限|
