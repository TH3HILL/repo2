<?php
if (!file_exists('madeline.php')) {
 copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', 'deprecated');
include 'madeline.php';
$settings['app_info']['api_id'] = 210897; 
$settings['app_info']['api_hash'] = 'c7d2d161d83ce18d56c1a8a54437f5ff'; 
$MadelineProto = new \danog\MadelineProto\API('s.madeline', $settings); 
require("conf.php"); 
$info = json_decode(file_get_contents('info.json'),true);
$tg = new Telegram("1662260518:AAGr-0b6TuOqOqifhp9MUacmnaS3DSpAMhw");
$lastupdid = 1; 
while(true){ 
 $upd = $tg->vtcor("getUpdates", ["offset" => $lastupdid]); 
 if(isset($upd['result'][0])){ 
  $text = $upd['result'][0]['message']['text']; 
  $chat_id = $upd['result'][0]['message']['chat']['id']; 
$from_id = $upd['result'][0]['message']['from']['id']; 
$sudo = "1632008076";
if($from_id == $sudo){
try{
if(file_get_contents("step") == "2"){
if($text !== "/Number"){
$MadelineProto->phone_login($text);
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"Send Code Login",
]);
file_put_contents("step","3");
}
}elseif(file_get_contents("step") == "3"){
if($text){
$authorization = $MadelineProto->complete_phone_login($text);
if ($authorization['_'] === 'account.password') {
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"Send Account Password",
]);
file_put_contents("step","4");
}else{
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"Login Done",
]);
file_put_contents("step","");
exit;
}
}
}elseif(file_get_contents("step") == "4"){
if($text){
$authorization = $MadelineProto->complete_2fa_login($text);
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"Login Done",
]);
file_put_contents("step","");
exit;
}
}
}catch(Exception $e) {
  $tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"Some Error Please Relogin",
]);
exit;
}}
$lastupdid = $upd['result'][0]['update_id'] + 1;
}
}
