<?php
header('Content-Type: text/html; charset=utf-8');

// 支持的视频平台检测
function isSupportedPlatform($url) {
    $supported = [
        'iqiyi.com',    // 爱奇艺
        'youku.com',    // 优酷
        'mgtv.com',     // 芒果TV
        'qq.com',       // 腾讯视频
        'v.qq.com'      // 腾讯视频
    ];
    
    foreach ($supported as $domain) {
        if (strpos($url, $domain) !== false) {
            return true;
        }
    }
    return false;
}

if (!isset($_GET['url']) || empty($_GET['url'])) {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>zc解析 - 参数缺失</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                margin: 0;
                padding: 0;
                background: linear-gradient(135deg, #1a1a2e, #16213e);
                font-family: "Microsoft YaHei", sans-serif;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #fff;
            }
            .container {
                text-align: center;
                max-width: 500px;
                padding: 30px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 15px;
                backdrop-filter: blur(10px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .icon {
                font-size: 60px;
                margin-bottom: 20px;
                color: #ff6b6b;
            }
            h1 {
                margin: 0 0 15px;
                font-weight: 300;
            }
            p {
                margin: 0 0 25px;
                line-height: 1.6;
                opacity: 0.8;
            }
            .btn {
                display: inline-block;
                padding: 10px 25px;
                background: #4e54c8;
                color: white;
                text-decoration: none;
                border-radius: 50px;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
            .btn:hover {
                background: #6a6fd8;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1>缺少必要参数</h1>
            <p>请提供视频链接URL参数以继续解析，例如：?url=视频链接</p>
            <button class="btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> 返回
            </button>
        </div>
    </body>
    </html>';
    exit;
}

$videoUrl = trim($_GET['url']);

// 检查是否支持该平台
if (!isSupportedPlatform($videoUrl)) {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>zc解析 - 不支持的平台</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                margin: 0;
                padding: 0;
                background: linear-gradient(135deg, #1a1a2e, #16213e);
                font-family: "Microsoft YaHei", sans-serif;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #fff;
            }
            .container {
                text-align: center;
                max-width: 500px;
                padding: 30px;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 15px;
                backdrop-filter: blur(10px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .icon {
                font-size: 60px;
                margin-bottom: 20px;
                color: #ff6b6b;
            }
            h1 {
                margin: 0 0 15px;
                font-weight: 300;
            }
            p {
                margin: 0 0 25px;
                line-height: 1.6;
                opacity: 0.8;
            }
            .supported-list {
                text-align: left;
                margin: 20px 0;
                padding: 0;
                list-style: none;
            }
            .supported-list li {
                margin-bottom: 10px;
                padding-left: 25px;
                position: relative;
            }
            .supported-list li:before {
                content: "✓";
                color: #4e54c8;
                position: absolute;
                left: 0;
            }
            .btn {
                display: inline-block;
                padding: 10px 25px;
                background: #4e54c8;
                color: white;
                text-decoration: none;
                border-radius: 50px;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }
            .btn:hover {
                background: #6a6fd8;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body>
        <div class="container">
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
            <h1>不支持的视频平台</h1>
            <p>您提供的链接不是支持的视频平台，目前仅支持以下平台：</p>
            <ul class="supported-list">
                <li>爱奇艺 (iqiyi.com)</li>
                <li>优酷 (youku.com)</li>
                <li>芒果TV (mgtv.com)</li>
                <li>腾讯视频 (v.qq.com)</li>
            </ul>
            <button class="btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> 返回
            </button>
        </div>
    </body>
    </html>';
    exit;
}

$encodedUrl = urlencode($videoUrl);
?>
<!DOCTYPE html>
<html>
<head>
    <title>zc解析</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
            overflow: hidden;
            height: 100vh;
            font-family: Arial, sans-serif;
            touch-action: manipulation;
        }
        #video-container {
            width: 100%;
            height: 100vh;
            position: relative;
        }
        #video-player {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: none;
        }
        .loading {
            color: white;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            width: 100%;
        }
        .loader {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
        }
        .loader-inner {
            position: absolute;
            border: 4px solid transparent;
            border-radius: 50%;
            animation: rotate 2s linear infinite;
        }
        .loader-inner:nth-child(1) {
            width: 100%;
            height: 100%;
            border-top-color: #4e54c8;
            border-bottom-color: #4e54c8;
            animation-delay: 0.1s;
        }
        .loader-inner:nth-child(2) {
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
            border-left-color: #8f94fb;
            border-right-color: #8f94fb;
            animation-delay: 0.2s;
        }
        .loader-inner:nth-child(3) {
            width: 60%;
            height: 60%;
            top: 20%;
            left: 20%;
            border-top-color: #4e54c8;
            border-bottom-color: #4e54c8;
            animation-delay: 0.3s;
        }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loading-text {
            font-size: 18px;
            margin-bottom: 15px;
            color: #8f94fb;
        }
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .particle {
            position: absolute;
            background: rgba(143, 148, 251, 0.5);
            border-radius: 50%;
            animation: float 5s infinite ease-in-out;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        .timeout-message {
            color: #8f94fb;
            margin-top: 15px;
            font-size: 14px;
            opacity: 0.8;
        }
        .error {
            color: #ff5555;
            text-align: center;
            padding: 20px;
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            max-width: 80%;
            z-index: 20;
        }
    </style>
</head>
<body>
    <div id="video-container">
        <video id="video-player" controls playsinline webkit-playsinline x5-playsinline></video>
        <div class="loading" id="loading">
            <div class="loader">
                <div class="loader-inner"></div>
                <div class="loader-inner"></div>
                <div class="loader-inner"></div>
            </div>
            <p class="loading-text">正在解析视频链接，请稍候...</p>
            <div class="timeout-message" id="timeout-message"></div>
        </div>
        <div class="error" id="error-message"></div>
        <div class="particles" id="particles"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
       
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = Math.floor(window.innerWidth / 10);
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                
                const size = Math.random() * 5 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                
                particle.style.animationDelay = `${Math.random() * 5}s`;
                particle.style.animationDuration = `${Math.random() * 5 + 3}s`;
                
                container.appendChild(particle);
            }
        }
        
      
        createParticles();
        
        function parseVideo() {
            const loading = document.getElementById('loading');
            const videoPlayer = document.getElementById('video-player');
            const errorMsg = document.getElementById('error-message');
            const timeoutMsg = document.getElementById('timeout-message');
            
            const timeoutTimer = setTimeout(() => {
                timeoutMsg.textContent = '解析时间较长，请耐心等待...';
            }, 10000);
            
            fetch('proxy.php?url=<?php echo $encodedUrl; ?>')
                .then(response => response.json())
                .then(data => {
                    clearTimeout(timeoutTimer); 
                    if (data.code === "200" && data.url) {
                        playVideo(data.url);
                    } else {
                        showError(data.message || '解析失败');
                    }
                })
                .catch(error => {
                    clearTimeout(timeoutTimer); 
                    showError('请求失败（请确保链接正确，如正常重试即可）: ' + error.message);
                });
                
            function playVideo(m3u8Url) {
                if (Hls.isSupported()) {
                    const hls = new Hls({
                        maxBufferLength: 30,
                        maxMaxBufferLength: 600,
                        maxBufferSize: 60 * 1000 * 1000,
                        maxBufferHole: 0.5
                    });
                    hls.loadSource(m3u8Url);
                    hls.attachMedia(videoPlayer);
                    hls.on(Hls.Events.MANIFEST_PARSED, function() {
                        loading.style.display = 'none';
                        videoPlayer.style.display = 'block';
                        // 手机端自动全屏
                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                            videoPlayer.requestFullscreen().catch(e => console.log(e));
                        }
                    });
                    hls.on(Hls.Events.ERROR, function(event, data) {
                        if (data.fatal) {
                            showError('视频加载失败: ' + data.type);
                        }
                    });
                } else if (videoPlayer.canPlayType('application/vnd.apple.mpegurl')) {
                    videoPlayer.src = m3u8Url;
                    videoPlayer.addEventListener('loadedmetadata', function() {
                        loading.style.display = 'none';
                        videoPlayer.style.display = 'block';
                        // 手机端自动全屏
                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                            videoPlayer.requestFullscreen().catch(e => console.log(e));
                        }
                    });
                } else {
                    showError('您的浏览器不支持HLS视频播放');
                }
            }
            
            function showError(message) {
                loading.style.display = 'none';
                errorMsg.style.display = 'block';
                errorMsg.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            }
        }
        
       
        parseVideo();
    </script>
</body>
</html>
<?php
$proxyContent = <<<'PROXY'
<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

if (!isset($_GET['url']) || empty($_GET['url'])) {
    echo json_encode(['code' => '400', 'message' => '缺少url参数']);
    exit;
}

$videoUrl = trim($_GET['url']);
$apiUrl = 'https://wwm.34bc.com/API/jhjx.php?url=' . urlencode($videoUrl);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo json_encode(['code' => '500', 'message' => '请求失败: ' . curl_error($ch)]);
    exit;
}

curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['code' => $httpCode, 'message' => 'API请求失败']);
    exit;
}

$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['code' => '500', 'message' => '解析API响应失败']);
    exit;
}

echo json_encode($data);
?>
PROXY;

if (!file_exists('proxy.php')) {
    file_put_contents('proxy.php', $proxyContent);
}
?>
