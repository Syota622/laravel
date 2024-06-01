<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form id="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>
        <button type="submit">Register</button>
    </form>

    <script>
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault(); // フォームのデフォルトの送信を防止

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Custom-Header': 'B9mU2TJe',
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert('Registration successful');
                    window.location.href = '/'; // リダイレクト先を設定
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
