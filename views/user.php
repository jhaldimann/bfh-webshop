<?php
    include('./header.php');
    include('./login.php');
    include('./footer.php');
    include('./sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GameFameClothing</title>
</head>
<body>

<section class="user-info">
    <?php
        $result = getUser($_SESSION['id']);
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<h1>".$row['prename']." ".$row['name']."</h1>";
            echo "<p>Email: ".$row['email']."</p>";

        }
    ?>
</section>

</body>
<link rel="stylesheet" href="../styles/user.css">
</html>

