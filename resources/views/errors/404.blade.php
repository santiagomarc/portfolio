<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Lexend', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #2c3e50;
            overflow: hidden;
        }
        .error-container {
            text-align: center;
            padding: 40px 20px;
            max-width: 520px;
        }
        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: #3498db;
            line-height: 1;
            letter-spacing: -4px;
        }
        .error-code span {
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }
        .error-code span:nth-child(2) { animation-delay: 0.2s; }
        .error-code span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .error-title {
            font-size: 24px;
            font-weight: 600;
            margin: 20px 0 12px;
            color: #2c3e50;
        }
        .error-message {
            font-size: 16px;
            color: #7f8c8d;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #3498db;
            color: #fff;
            box-shadow: 0 4px 12px rgba(52,152,219,0.3);
        }
        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        .btn-outline {
            background: transparent;
            color: #3498db;
            border: 2px solid #3498db;
        }
        .btn-outline:hover {
            background: #3498db;
            color: #fff;
            transform: translateY(-2px);
        }
        .decoration {
            margin-top: 40px;
            font-size: 13px;
            color: #bdc3c7;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">
            <span>4</span><span>0</span><span>4</span>
        </div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-message">
            The page you're looking for doesn't exist or has been moved.
            Let's get you back on track.
        </p>
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                ← Back to Home
            </a>
            <a href="javascript:history.back()" class="btn btn-outline">
                Go Back
            </a>
        </div>
        <p class="decoration">Marc Santiago — Portfolio</p>
    </div>
</body>
</html>
