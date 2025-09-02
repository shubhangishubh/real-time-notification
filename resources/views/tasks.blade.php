<!-- resources/views/tasks.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Notifications</title>
    <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
    @vite('resources/js/app.js') <!-- if you are using Vite -->
</head>
<body>
    <h1>Listening for Task Notifications...</h1>
    
    <script>
        console.log('Setting up Echo listener for tasks channel');
        window.Echo.channel('tasks')
            .listen('.realTask.created', (e) => {
                console.log('New Task:', e);
                alert(`New Task: ${e.title} | Assigned to: ${e.assigned_user_id}`);
            });
    </script>
</body>
</html>
