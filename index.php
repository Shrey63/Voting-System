<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voting System - Home</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e6f0ff, #ffffff);
            color: #003366;
        }

        .header {
            background-color: #003366;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .image-section {
            flex: 1 1 300px;
            text-align: center;
            padding: 20px;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .content-section {
            flex: 1 1 300px;
            padding: 20px;
            text-align: center;
        }

        .content-section h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .content-section p {
            font-size: 1.1em;
            margin-bottom: 30px;
            color: #333;
        }

        .button-group a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            font-size: 1em;
            color: white;
            background-color: #0059b3;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button-group a:hover {
            background-color: #004080;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-section, .content-section {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Welcome to the Voting System</h1>
    </div>

    <div class="container">
        <div class="image-section">
            <!-- <img src="https://www.shutterstock.com/image-illustration/3d-hand-putting-voting-envelope-260nw-2354292683.jpg" alt="Voting Illustration"> -->
            <img src="https://ggapartners.com/wp-content/uploads/post/brave-new-world-online-voting/19032/2023/08/Wordpress-Featured-Header-900-x-500-px-4.jpg" alt="Voting Illustration">
        </div>
        <div class="content-section">
            <h2>Your Voice Matters</h2>
            <p>Participate in the democratic process by registering and casting your vote. Make a difference today!</p>
            <div class="button-group">
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
