<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إرسال طلب JSON</title>
</head>
<body>
    <form id="jsonForm">
        <input type="text" id="name" name="name" placeholder="الاسم">
        <input type="email" id="email" name="email" placeholder="البريد الإلكتروني">
        <textarea id="message" name="message" placeholder="الرسالة"></textarea>
        <button type="submit">إرسال</button>
    </form>

    <script>
        document.getElementById('jsonForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value,
            };

            fetch('{{ route('submit.json') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                alert(data.success);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
