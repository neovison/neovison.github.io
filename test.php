<?php
    $data = json_decode(file_get_contents('php://input'));
    $u_id = $data->object->user_id;
    $mess = $data->object->body;
    $album = 'https://vk.com/album-57536014_22704248';
    $res = parse_url($album);
    $path = substr($res['path'], 6);
    $arr = explode('_', $path);
    $owner_id = $arr[0];
    $album_id = $arr[1];
    $standalone = 'e1133f86f00fed298885a32d2a3b372a232ff54ee2ff825d3463f3862fc78541f8a070f7cefe4a4700b4';
    $group_token = '5cb91e923115ea48e6d809cbbd866559000cb17342cf530369aa4230c0dfe14934fab41b3edea02290674';
    $conf = [
    	'standalone' => $standalone,
    	'group_token' => $group_token,
    	'contorm_token' => '34e9d426',
    	'mess' => 'Иха йоба',
    	'not_command' => 'Ничего не понял.',
    	'owner_id' => $owner_id,
    	'album_id' => $album_id,
    	'group_id' => 'neovison_shop',
    	'apiurl' => 'https://api.vk.com/method/',
    	'path' => substr($_SERVER['PHP_SELF'], 0, -2),
    	'photos' => 'photos.txt',
    	'temp_link' => 'temp_album.txt',
    	'random_id' => mt_rand(0000000000, 999999999999),
    	'v' => '5.50'
    ];

    $user_info = json_decode(file_get_contents($conf['apiurl'].'users.get?user_id='.$u_id.'&v='.$conf['v'].'&access_token='.$conf['standalone']));
    $user_name = $user_info->response[0]->first_name;

    $temp_link = file($conf['temp_link']);
    if($temp_link[0] != $album) {
    	file_put_contents($conf['temp_link'], $album);
    	unlink($conf["photos"]);
        $query = file_get_contents($conf['apiurl'].'photos.get?owner_id='.$conf['owner_id'].'&album_id='/$conf['album_id'].'&v='.$conf['v'].'&access_token='.$conf['standalone']);
        $res = json_decode($query, true);
        foreach($res as $v) {
	        foreach($v['items'] as $q) {
	 	        $result = 'photo'.$q['owner_id'].'_'.$q['id'];
	 	        file_put_contents($conf['photos'], $result."\n", FILE_APPEND | LOCK_EX);
	        }
        } 
    	return true;
    }

    switch($data->type) {
    	case 'confirmation':
     		echo $conf['contorm_token'];
    		break;
    	case "message_new":
    		if($mess == $conf['mess']) {
    			$file = file_get_contents($conf['photos']);
    			$photos_all = explode("\n", $file);
    			
    			$myCurl = curl_init();
    			curl_setopt_array($myCurl, array(
    				CURLOPT_URL => $conf['apiurl'].'messages.send?user_id='.$u_id.'&group_id='.$conf['group_id'].'&attachment='.$photos_all[mt_rand(0, count($photos_all) - 1)].'&message='.urlencode('Держи свое фото').'&v='.$conf['v'].'&access_token='.$conf['standalone'],
    				CURLOPT_RETURNTRANSFER => true,
    				CURLOPT_POST => true,
    				CURLOPT_POSTFIELDS => http_build_query(array())
    			));
    			$response = curl_exec($myCurl);
    			curl_close($myCurl);
    		} else {
    			$myCurl = curl_init();
    			curl_setopt_array($myCurl, array(
    				CURLOPT_URL => $conf['apiurl'].'messages.send?user_id='.$u_id.'&group_id='.$conf['group_id'].'&message='.urlencode($conf['not_command']).'&v='.$conf['v'].'&access_token='.$conf['standalone'],
    				CURLOPT_RETURNTRANSFER => true,
    				CURLOPT_POST => true,
    				CURLOPT_POSTFIELDS => http_build_query(array())
    			));
    			$response = curl_exec($myCurl);
    			curl_close($myCurl);
    		}
    		echo 'ok';
    		break;
    }
?>
