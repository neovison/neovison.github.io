<?php
    $album = 'https://vk.com/album-31976785_251490889';
    $res = parse_url($album);
    $path = substr($res['path'], 6);
    $arr = explode('_', $path);
    $owner_id = $arr[0];
    $album_id = $arr[1];
?>
