<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do list</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet">
</head>
<body>
<header class="mt-3 mb-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid pl-0">
                <div class="navbar-brand"><a class="navbar-brand fs-4 mr-3" href="/">To do list</a></div>

                <?php if (isset($_SESSION['login'])): ?>
                    <a type="button" class="btn btn-secondary" href="/logout">
                        Выйти
                    </a>
                <?php else: ?>
                    <a type="button" class="btn btn-secondary" href="/login">
                        Войти
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

