<!-- resources/views/tasks.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <title>Task Notifications</title>
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
    @vite('resources/js/app.js') <!-- if you are using Vite -->
</head>
<body>
    <h1>Listening for Task Notifications...</h1>
    
</body>
</html>
