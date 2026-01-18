<?php

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'ad_system');
    define('APPROOT', dirname(dirname(__FILE__)));

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];

    $project_root = dirname(dirname(dirname(__FILE__)));
    $doc_root = $_SERVER['DOCUMENT_ROOT'];

    $project_root = str_replace('\\', '/', $project_root);
    $doc_root = str_replace('\\', '/', $doc_root);
    $web_path = str_replace($doc_root, '', $project_root);
    $web_path = str_replace(' ', '%20', $web_path);

    define('URLROOT', $protocol . '://' . $host . $web_path . '/Public');
    define('SITENAME', 'BuySell.lk');

?>
