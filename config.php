<?php
    $album = 'https://vk.com/album-57536014_22704248';
    $res = parse_url($album);
    $path = substr($res['path'], 6);
    $arr = explode('_', $path);
    $owner_id = $arr[0];
    $album_id = $arr[1];

    $standalone = "e1133f86f00fed298885a32d2a3b372a232ff54ee2ff825d3463f3862fc78541f8a070f7cefe4a4700b4";
    $group_token = '5cb91e923115ea48e6d809cbbd866559000cb17342cf530369aa4230c0dfe14934fab41b3edea02290674';
    $conf = [
    	'standalone' => $standalone,
    	'group_token' => $group_token,
    	'contorm_token' => 'eae5d4a2',
    	'mess' => 'Иха йоба',
    	'not_command' => 'Ничего не понял.',
    	'owner_id' => $owner_id,
    	'album_id' => $album_id,
    	'group_id' => '170785666',
    	'apiurl' => 'https://api.vk.com/method/',
    	'path' => substr($_SERVER['PHP_SELF'], 0, -2),
    	'photos' => 'photos.txt',
    	'temp_link' => 'temp_album.txt',
    	'random_id' => mt_rand(0000000000, 999999999999),
    	'v' => '5.50'
    ];
?>
