<?php
$url = 'https://videos.pexels.com/video-files/3205917/3205917-uhd_2560_1440_25fps.mp4';
$file = 'public/videos/hero-fashion.mp4';
if (!is_dir('public/videos')) {
    mkdir('public/videos', 0777, true);
}
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36\r\n"
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
