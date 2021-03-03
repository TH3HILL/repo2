<?php
$m = "/root/";
require('conf.php');
$info = json_decode(file_get_contents('info.json'),true);
$token =  readline("- Enter Token : ");
$id = readline("- Enter iD : ");
$info["token"] = "$token";
file_put_contents($m.'/info.json', json_encode($info));
$info["id"] = "$id";
file_put_contents($m.'/info.json', json_encode($info));
$tg = new Telegram($info["token"]);
$lastupdid = 1;
while(true){
 $upd = $tg->vtcor("getUpdates", ["offset" => $lastupdid]);
 if(isset($upd['result'][0])){
  $text = $upd['result'][0]['message']['text'];
  $chat_id = $upd['result'][0]['message']['chat']['id'];
$from_id = $upd['result'][0]['message']['from']['id'];
$username = $upd['result'][0]['message']['from']['username'];
$sudo = $info["id"];
if($from_id == $sudo){ 
if($text == '/start'){ 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"Hi in Checker @ZeZZZ
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▪️ /run => Run The Checker
▫️ /stop => stop The Checker
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▪️ /first + @User => Add First UserName
▫️ /add + @User => Add UserName
▪️ /rem + @User => Remove User
▫️ /clear => Remove All The List
▪️ /user => Show List Users
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▪️ /setac => Move in Account
▫️ /setch => Move in Channelr
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▫️ /Number => Login New Account
▪️ /Tr => الاوامر بلعربي
"
]); 
} 
if(preg_match('/\/first @.*/', $text)){
$users = explode (file_get_contents("users"));
$text = str_replace('/first @', '', $text);
if(!in_array($text,$users)){
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>'Added To List', 
]);
file_put_contents("users", trim("$text",""),FILE_APPEND);
}
}
if(preg_match('/\/add @.*/', $text)){
$users = explode ("\n",file_get_contents("users"));
$text = str_replace('/add @', '', $text);
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>'Added To List', 
]);
$e = file_put_contents("users", trim("\n$text",""),FILE_APPEND);
}}
if($text  == "/setch"){ 
file_put_contents("type" , "Channel"); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"The Move Now On Channel", 
]); 
} 
if($text  == "/setac"){ 
file_put_contents("type" , "Account"); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"The Move Now On Account", 
]); 
} 
if($text  == "/users"){ 
$user = file_get_contents("users"); 
$se = str_replace("\n","\n@",$user); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"The Users in The List \n@".$se, 
]); 
} 
if($text  == "/Tr"){ 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"Hi in Checker @ZeZZZ
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▪️ /run => تشغيل التشيكر
▫️ /stop => ايقاف التشيكر
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▪️ /first + @User => اضافة اول معرف
▫️ /add + @User => اضافة معرف
▪️ /rem + @User => حذف معرف
▫️ /clear => حذف كل المعرفات
▪️ /user => عرض لستة المعرفات
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▪️ /setac => تحديد صيد بحساب
▫️ /setch => تحديد صيد بقناة
_  _  _  _  _  _  _  _  _  _  _  _  _  _
▫️ /Number => تسجيل حساب جديد للتشيكر", 
]); 
} 
if(preg_match('/(rem @)/', $text )) { 
$ex = explode('/rem @',$text); 
$user = file_get_contents("users"); 
$s = str_replace(" ","\n",$ex[1]); 
$se = str_replace($s."\n","",$user); 
file_put_contents("users",$se); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"@$ex[1] Removed From List", 
]); 
} 
if($text == '/clear'){ 
file_put_contents("users",""); 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"The List is Clear Now", 
]); 
} 
if($text == '/run'){
shell_exec('screen -dmS checker php u.php'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"The Checker is Running Now",
]);
}
if($text == '/stop'){
  shell_exec('screen -S checker -X kill'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"The Checker is stop Now",
]);
}
if($text == '/Number'){
	system('rm -rf *m*');
file_put_contents("step","");
if(file_get_contents("step") == ""){
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"Send The Number 
EX : +964**********",
]);
file_put_contents("step","2");
  system('php g.php');

}
}
} 
$lastupdid = $upd['result'][0]['update_id'] + 1; 
} 
