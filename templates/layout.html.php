<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>

    <link rel="stylesheet" href="/styles.css">
</head>

<body>
    <nav>
        <header>
            <h1>Internet Joke Database</h1>
        </header>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/joke/list">Jokes List</a></li>
            <li><a href="/joke/edit">Add a new joke</a></li>
        </ul>
    </nav>

    <main>
        <?= $output ?>
    </main>

    <footer>
        &copy; IJDB 2023
    </footer>
</body>

</html>
