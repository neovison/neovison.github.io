<?php
    $album = 'https://vk.com/album-57536014_227042485';
    $res = parse_url($album);
    $path = substr($res['path'], 6);
    $arr = explode('_', $path);
    $owner_id = $arr[0];
    $album_id = $arr[1];
    
    $standalone = "e1133f86f00fed298885a32d2a3b372a232ff54ee2ff825d3463f3862fc78541f8a070f7cefe4a4700b4";
    $conf = [
        'standalone' => $standalone,
        'group_token' => '5cb91e923115ea48e6d809cbbd866559000cb17342cf530369aa4230c0dfe14934fab41b3edea02290674',
        'contorm_token' => '34e9d426',
        'mess' => 'Иха йоба',
        'not_command' => 'Не, я тебя не понимаю.. Попробуй ещё раз.',
        'owner_id' => $owner_id,
        'alnum_id' => $album_id,
        'group_id' => 'neovison_shop',
        'apiurl' => 'https://api.vk.com/method/',
       // 'path' => substr($_SERVER['PHP_SELF'], 0, -7),
        'photos' => 'photos.txt',
        'temp_link' => 'temp_album.txt',
        'random_id' => mt_rand(0000000000, 999999999999),
        'v' => '5.50'
    ];
?>
