<?php

// not working
function registerJsUrl($url) {
    if(!$url) return;
    // $context->addJs($url);
    $context = '<script src="' . $url . '"></script>';
    return $context;
}

function registerCssUrl($url) {
    if(!$url) return;
    // $context->addCss($url);
    $context = '<link rel="stylesheet" type="text/css" href="' . $url . '">';
    return $context;
}