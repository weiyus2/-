<?php
// 从URL参数中获取oid值，如果没有则使用默认值
$oid = isset($_GET['oid']) ? $_GET['oid'] : 'https://www.bilibili.com/123';

// API地址
$apiUrl = 'https://api.bilibili.com/x/share/click';

// 准备POST数据
$postData = [
    'access_key' => '',  // 如果需要，请在这里填写你的access_key
    'build' => '8260300',
    'buvid' => 'XY873B38A615F57497B0C6C2D3D363B74C0FB',
    'disable_rcmd' => '0',
    'platform' => 'android',
    'share_channel' => 'WEIXIN',
    'share_id' => 'activity.webview.0.0.pv',
    'share_mode' => '1',
    'oid' => $oid  // 使用从URL获取的oid值
];

// 初始化cURL
$ch = curl_init();

// 设置cURL选项
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// 设置请求头
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
]);

// 执行请求
$response = curl_exec($ch);

// 检查是否有错误
if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    // 直接输出API返回的数据
    echo $response;
}

// 关闭cURL
curl_close($ch);
?>