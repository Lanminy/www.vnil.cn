# Vnil视频/图集解析去水印接口文档

## Vnil(https://www.vnil.cn) 解析接口已支持：抖音、快手、小红书、剪映、Tiktok、微博、西瓜视频、今日头条、绿洲、美图秀秀、instagram、趣头条、火锅视频、微视、火山、皮皮虾、好看视频、刷宝、全民小视频、QQ看点、陌陌视频、UC浏览器、Youtube、轻视频、Bilibili、茄子短视频最右、小咖秀、皮皮搞笑、阳光宽频网、淘宝、天猫、一淘、拼多多、京东、京东晒一晒、美拍、1688(阿里巴巴)、考拉、唯品会等超过40个平台的视频/图集去水印解析。
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

	{"code":0,"msg":"success","body":{"url":"https://item.jd.com/3274923.html","platform":"jd","text":"欧普照明（OPPLE）厨卫灯 led平板灯集成吊顶天花板铝扣面板厨房卫生间嵌入式300*600 银色白光18w","images":["https://m.360buyimg.com/mobilecms/s750x750_jfs/t1/111404/12/12803/89591/5f1473c8E79a4a52f/7a5c353cc263fca9.jpg","https://m.360buyimg.com/mobilecms/s750x750_jfs/t1/92420/5/16539/166250/5e7cbce9E82c78518/49fb2eee11eb3f40.jpg","https://m.360buyimg.com/mobilecms/s750x750_jfs/t30010/250/1163655861/175147/d1f340ca/5cd91446Nc4f27204.jpg","https://m.360buyimg.com/mobilecms/s750x750_jfs/t1/15780/8/8700/167083/5c790abfE091e5b1b/03695a3b0a8ffccd.jpg","https://m.360buyimg.com/mobilecms/s750x750_jfs/t1/32677/34/3994/103106/5c790abeE7c3e48b7/7a0072f41a2cd982.jpg","https://m.360buyimg.com/mobilecms/s750x750_jfs/t1/18986/27/8899/54085/5c790abeE04b5f9ac/1902142f7b3afb5f.jpg"],"video_info":{"cover":"https://img.300hu.com/4c1f7a6atransbjngwcloud1oss/409860b9203912066732920833/imageSampleSnapshot/1563352521_433041572.100_5977.jpg","url":"https://vod.300hu.com/4c1f7a6atransbjngwcloud1oss/409860b9203912066732920833/v.f30.mp4?dockingId=a771bd9f-666d-4e67-91f8-a110301e6879&storageSource=3"},"type":3,"cover":"https://m.360buyimg.com/mobilecms/s750x750_jfs/t1/111404/12/12803/89591/5f1473c8E79a4a52f/7a5c353cc263fca9.jpg"}}
	
  
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

### 二. 获取作者信息接口：根据作者分享页url(目前仅支持抖音)
**请求地址：https://api.vnil.cn/api/batch/getAuthorInfo**  
**请求方式：GET/POST**  
**请求参数：**  

|字段|类型|必填|备注|赋值|
|---|---|---|---|---|  
| appkey | string | Y | appid |开发者后台生成的appkey |
| url | string | Y | 作者分享页url(目前仅支持抖音) |

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


### 三. 获取短视频平台作者信息接口：根据用户ID(目前仅支持抖音)
**请求地址：https://api.vnil.cn/api/batch/getAuthorInfoByNumber**  
**请求方式：GET/POST**  
**请求参数：**  

|字段|类型|必填|备注|赋值|
|---|---|---|---|---|  
| appkey | string | Y | appid |开发者后台生成的appkey |
| number | string | Y | 用户ID（目前仅支持抖音号） ||

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
|avatar|头像|
|desc|简介||
|follower|粉丝数||
|focus|关注数||

PHP EXAMPLE：

PHP file\_get\_contents:
	
	//开发者后台生成的appkey
	$appkey = '';

	//需要解析的短视频平台作者ID
	$number = '';
	
	$param = [
		'appkey'	=> $appkey,
		'number'	=> $number,
	];
	
	//得到请求的地址：https://api.vnil.cn/api/batch/getAuthorInfoByNumber?appid=&appsecret=&number=
	$apiUrl = 'https://api.vnil.cn/api/batch/getAuthorInfoByNumber?'.http_build_query($param);
	$videoInfo = file_get_contents($apiUrl);
	print_r($videoInfo);


PHP curl为例：
	
	//开发者后台生成的appkey
	$appkey = '';
	
	//需要解析的短视频平台作者ID
	$number = '';
	
	$param = [
		'appkey'	=> $appkey,
		'number'	=> $number,
	];
	
	//得到请求的地址：https://api.vnil.cn/api/batch/getAuthorInfoByNumber?appid=&appsecret=&number=
	$apiUrl = 'https://api.vnil.cn/api/batch/getAuthorInfoByNumber?'.http_build_query($param);
	
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




### 四. 获取作者作品列表(目前仅支持抖音)
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

	{"code":0,"msg":"success","body":{"uid":"56009474501","platform":"douyin","page":{"current_cursor":"","next_cursor":1601703325000,"has_more":true},"list":[{"video_info":{"desc":"豪华婚礼现天价陪嫁礼单：现金280多万加创业基金2000多万，外加豪车、房产…数学好的可以算一下总价值！","url":"https://www.iesdouyin.com/share/video/6879811223831989517/","cover":"https://p3-dy-ipv6.byteimg.com/img/tos-cn-p-0015/e932dc887539471cb745f712aada2176_1601830891~c5_300x400.jpeg?from=2563711402_large"},"like_count":5956,"comment_count":25}]}}
	
  
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
| next_cursor |翻页请求游标||
| has_more |是否有更多|true标识有更多，需要翻页请求，false标识无|

**接入注意点** 

	这里需要说明的是：
	1、返回的作品列表中视频url为有水印的视频网页访问地址，如需获取无水印的视频原始信息，请将当前获取的视频地址作为参数调用去水印解析接口
	2、当"page"下的"has_more"为"true"时，则表示下面还有内容，所需翻页获取，请将"next_cursor"作为参数"cursor",再次调用当前接口(获取作者作品列表)




### 无、获取开发者信息接口
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
