
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $document->title }}</title>

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background: #f5f5f5;
        }

        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>

<body>

    <iframe
        src="{{ asset('storage/' . $document->attachment) }}"
        type="application/pdf">
    </iframe>

</body>

</html>
