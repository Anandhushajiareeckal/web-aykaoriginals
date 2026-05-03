<?php
$url = 'https://assets.mixkit.co/videos/preview/mixkit-fashion-model-posing-on-a-studio-background-34657-large.mp4';
$file = 'public/videos/hero-fashion.mp4';
if (!is_dir('public/videos')) {
    mkdir('public/videos', 0777, true);
}
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
    ]
];
$context = stream_context_create($opts);
$content = file_get_contents($url, false, $context);
if ($content) {
    file_put_contents($file, $content);
    echo "Downloaded: " . filesize($file) . " bytes\n";
} else {
    echo "Failed to download\n";
}
