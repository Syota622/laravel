<!-- resources/views/messages/form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message to SQS</title>
</head>
<body>
    <h1>Send Message to SQS</h1>
    <form method="POST" action="/messages">
        @csrf
        <input type="text" name="message" placeholder="Enter your message">
        <button type="submit">Send</button>
    </form>
</body>
</html>
