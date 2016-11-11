<?php
session_start();
?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop - Feedback</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
    <link rel="stylesheet" href="../css/Feedback.css">

</head>
<body>
    <?php
    include('menuu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <h2>FEEDBACK FORM</h2>
    <form action="contact_form.php" method="post">
        <p>
            <input type="text" class="simple-textbox" name="name" placeholder="Enter Your name" required />
        </p>
        <p>
            <input type="email" class="simple-textbox" name="email" placeholder="Enter Your e-mail" required />
            <span class="form_hint">Correct format "name@something.com"</span>
        </p>
        <p>
            <textarea type="text" class="simple-textbox" name="message"  placeholder="Message" cols="40" rows="6" ></textarea>
        </p>
        <button class="simple-button">SEND</button>
    </form>
    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>