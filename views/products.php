<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Products</title>
    </head>
    <body>
        <?php include './header.php'; ?>
        <?php include './sidebar.php'; ?>

        <section class="">
            <?php echo "<h1>".$_GET['type']."</h1>"; ?>
        </section>
        <?php include './footer.php'; ?>
    </body>
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</html>

