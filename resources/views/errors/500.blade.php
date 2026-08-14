<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error | The Media Com</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }
        .error-container {
            max-width: 600px;
            padding: 2rem;
            background: #1e293b;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid #334155;
        }
        h1 {
            font-size: 6rem;
            margin: 0;
            color: #ef4444;
            line-height: 1;
            font-weight: 800;
        }
        h2 {
            font-size: 1.5rem;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
            color: #e2e8f0;
        }
        p {
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            background-color: #ef4444;
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }
        .btn:hover {
            background-color: #dc2626;
        }
        .logo-placeholder {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>500</h1>
        <h2>Oops! Something went wrong.</h2>
        <p>We're experiencing an internal server issue right now. Our technical team has been notified. Please try again in a few minutes or return to the homepage.</p>
        <a href="{{ url('/') }}" class="btn">Return to Homepage</a>
    </div>
</body>
</html>
