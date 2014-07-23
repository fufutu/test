<?php
ini_set('display_errors', 'Off');
error_reporting(E_ALL & ~E_NOTICE);

include 'Baidu-BCS_SDK-PHP-1.2.2/bcs.class.php';

$bcs_ak = '6OWBAxYc7TGl3DiGt5HOAWGC';
$bcs_sk = 'A0wcYXbitWDaOkGIZ5eCG4RjMDb9c40k';
$bcs_host = 'bcs.duapp.com';
$baiduBCS = new BaiduBCS($bcs_ak, $bcs_sk, $bcs_host);

$bucket = 'fufutu-image';//填入您申请bcs的bucket名称

//object name
$filename = 'src/fufutu/mediaBase/images/logo_18_18.jpg';//填入您要保存的名称
$filename = 'http://bcs.duapp.com/fufutu-image/%7BA6695B61-D63A-48B8-AF8B-856B510F9096%7D_meitu_2.jpg';
$filename = 'http://img3.douban.com/view/photo/albumcover/public/p1202999550.jpg';
$md5 = md5_file($filename);

$object = '/' . $md5[0] .'/' . $md5[1] . '/' . $md5[2] . '/' . $md5[3] . '/' . $md5.'.jpg';
function aa() {}
//将图片存入云存储
//$imageSrc即为请求image服务成功后返回的图片二进制数据
$opt = array();
$opt ['acl'] = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
	$opt [BaiduBCS::IMPORT_BCS_LOG_METHOD] = "aa";
$response = $baiduBCS->create_object_by_content($bucket, $object, file_get_contents($filename), $opt);
if(!$response->isOK()){
    die('Create object failed.');
} else {

    $meta = array("Content-Type" => BCS_MimeTypes::get_mimetype ( "jpg" ));
    $response = $baiduBCS->set_object_meta ( $bucket, $object, $meta );
}

//得到已存入云存储图片的url
$url = $baiduBCS->generate_get_object_url($bucket,$object);
if($url === false){
    die('Generate GET object url failed.'); 
}
echo $url;
