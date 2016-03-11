<!DOCTYPE html>
<html>
<head>
        <title>Show Book</title>
        <meta charset='utf-8'>
        <link href='/css/foobooks.css' type='text/css' rel='stylesheet'>
</head>
<body>

    <header>
        <img
        src='http://making-the-internet.s3.amazonaws.com/laravel-foobooks-logo@2x.png'
        style='width:300px'
        alt='Foobooks Logo'>
    </header>

    <section>
        {{ $abc }}

        @if(isset($title))
            <h1>Show book: {{ $title }}</h1>
        @else
            <h1>No book chosen</h1>
        @endif

        <?php if(isset($title)): ?>
            <h1>Show book: {{ $title }}</h1>
        <?php else: ?>
            <h1>No book chosen</h1>
        <?php endif; ?>

    </section>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</body>
