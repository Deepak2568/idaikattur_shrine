<?php

// Check if user is logged in as admin using Laravel's auth system
$isAdmin = false;

// Check for admin bypass URL parameter (for testing)
if (isset($_GET['admin_bypass']) && $_GET['admin_bypass'] === 'shs_admin') {
    $isAdmin = true;
    // Set cookie for future requests
    setcookie('admin_bypass', 'shs_admin', time() + (24 * 60 * 60), '/'); // 24 hours
}

// Check for admin bypass cookie
if (isset($_COOKIE['admin_bypass']) && $_COOKIE['admin_bypass'] === 'shs_admin') {
    $isAdmin = true;
}

// If user is admin, don't show maintenance page
if ($isAdmin) {
    // Let the application continue normally
    return;
}

http_response_code(503);
header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Maintenance - Sacred Heart Shrine</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: url("images/shs.png") no-repeat center center;
            background-size: cover;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: white;
            position: relative;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(29, 233, 182, 0.8) 0%, rgba(183, 33, 255, 0.8) 100%);
        }
        .maintenance-container {
            position: relative;
            z-index: 1;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 60px 40px;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            margin: 50px auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .shrine-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        }
        .maintenance-icon {
            font-size: 3rem;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        h1 {
            font-size: 2.8rem;
            margin-bottom: 25px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
            letter-spacing: 1px;
        }
        .shrine-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffd700;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 0.5px;
        }
        p {
            font-size: 1.3rem;
            line-height: 1.8;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        .tamil-text {
            font-size: 1.1rem;
            font-style: italic;
            color: #e8f4f8;
            margin-top: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        .contact-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .contact-info h5 {
            color: #ffd700;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .contact-info p {
            font-size: 1rem;
            margin-bottom: 10px;
        }
        .contact-info i {
            color: #dc3545;
            margin-right: 10px;
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="maintenance-container pulse">
            <h1>Site Under Maintenance</h1>
            <div class="shrine-title">SACRED HEART SHRINE</div>
            <p>We are currently performing scheduled maintenance to improve your experience and serve you better.</p>
            <p>Please check back soon. Thank you for your patience and understanding.</p>
            <div class="tamil-text">
                எமது இதய அன்பில் நிலைத்திருந்தால் எல்லா நன்மைகளும் பெறுவீர்கள்
            </div>
            <div class="contact-info">
                <h5><i class="fas fa-info-circle"></i>Contact Information</h5>
                <p><i class="fas fa-map-marker-alt"></i>Sacred Heart Shrine, Idaikattur, Sivagangai</p>
                <p><i class="fas fa-phone"></i>+91 91596 96893</p>
                <p><i class="fas fa-envelope"></i>sacredheartblessing@gmail.com</p>
            </div>
        </div>
    </div>
</body>
</html>';

exit;
