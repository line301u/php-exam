<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= out(isset($title) ? $title : 'Profile app'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body class="position-relative min-vh-100 pb-5">
    <main class="container">

        <?php
        if (isset($_SESSION['name'])) { ?>
            <section class="pt-4 d-flex align-items-center justify-content-between flex-row-reverse gap-3 mb-4 border-bottom pb-3">
                <a href="/php-exam/log-out" class="btn btn-outline-dark">Log out</a>
                <p class="m-0 h5"><?= out('Welcome ' . $_SESSION['name']); ?></p>
            </section>
        <?php
        }
        ?>