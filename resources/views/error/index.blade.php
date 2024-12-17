<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8fafc; /* Light background color */
            font-family: 'Roboto', sans-serif;
            text-align: center;
        }
        h1 {
            font-size: 5rem; /* Large font size */
            color: #4a5568; /* Dark gray color */
            margin: 0;
        }
        p {
            font-size: 1.5rem; /* Medium font size */
            color: #718096; /* Gray color */
        }
    </style>
    <meta http-equiv="refresh" content="5;url={{ route('movies.index') }}">
</head>
<body>
    <div>
        <h1>Merry Christmas Anne!</h1>
        <p>You will be redirected to the movies page shortly.</p>
        <img src="{{ asset('error.jpg') }}" alt="Error Image" style="width: 300px; height: auto;">
    </div>
</body>
</html>