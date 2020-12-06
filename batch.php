<?php
/**
 * 作品列表批量解析接口：支持解析 抖音、西瓜视频、微视、抖音火山版、美拍、火锅视频、好看视频、UC浏览器等平台
 */
 
//	www.vnil.cn开发者后台获得
$appkey 		= '';

//	要获取的作者主页地址
$url = 'https://v.ixigua.com/JXVC7dk/';

//	获取作者信息
$param	= [
	'appkey'		=> $appkey,
	'url'		=> $url,
];

$authorApi = 'https://api.vnil.cn/api/batch/getAuthorInfo';
$authorRes = curlPost($authorApi, $param);

$authorInfo = json_decode($authorRes, true);


//	获取视频列表信息
$param	= [
	'appkey'		=> $appkey,
	'uid'		=> $authorInfo['body']['author']['uid'],
	'platform'	=> $authorInfo['body']['platform'],
	'cursor'	=> '',
];

$listApi = 'https://api.vnil.cn/api/batch/getList';
$videoListRes = curlPost($listApi, $param);

print_r($videoListRes);


/**
 * curl post
 * @param string $url
 * @param unknown $param
 */
function curlPost($url = '', $param) {
	
	$userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36';
	$header = [
		'User-Agent: '.$userAgent,
	];
	
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt ( $ch, CURLOPT_USERAGENT, $userAgent );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_MAXREDIRS, 5 );
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param);
	
	$content = curl_exec($ch);
	curl_close($ch);
	
	return $content;
}
