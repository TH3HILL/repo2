<?php
define('API_KEY',"1662260518:AAGr-0b6TuOqOqifhp9MUacmnaS3DSpAMhw");
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}
if (!file_exists('madeline.php')) {    
copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');   
 }    
 define('MADELINE_BRANCH', 'deprecated');
include 'madeline.php';    
$MadelineProto = new \danog\MadelineProto\API('session.madeline');    
$MadelineProto->start();
$x = 0;
$Text = "Hi @iven4
New UserName : @$user
Clicks Count : $x
Moved To : $type
Time Update :".date('i:s')." ";
$admin = '1632008076';
$sudo = '1632008076';
$type = file_get_contents("type");
while(1){
$u = explode("\n",file_get_contents("users")); 
for($i=0; $i<count($u); $i++){ 
$user = $u[$i];
        if($user != ""){
if($type == "Channel"){
$updates = $MadelineProto->channels->createChannel(['broadcast' => true,'megagroup' => false,'title' => "B", ]);
$chat_mack = $updates['updates'][1];
while(1){
            try{
             $MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
echo '@'.$user." - ".$x." - ".date('i:s')."\n";
$x++;
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                        $MadelineProto->channels->updateUsername(['channel' => $chat_mack, 'username' => $user]);         
                        bot("sendmessage",[
'chat_id' => $admin,
'text' => $Text]);
exit;
                    }catch(Exception $e){
                            bot("sendmessage",[
'chat_id' => $admin,
'text' => "@$user ".$e->getMessage()]);
exit;
                        }

  
                    }
         }
}
}

          if($type == "Account"){
            try{
             $MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
echo '@'.$user." - ".$x." - ".date('i:s')."\n";
$x++;
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                        $MadelineProto->account->updateUsername(['username' => $user]);        
                        bot("sendmessage",[
'chat_id' => $admin,
'text' =>  $Text]);
exit;
                    }catch(Exception $e){
                            bot("sendmessage",[
'chat_id' => $admin,
'text' => "@$user ".$e->getMessage()]);
}
}
}
}
}