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
    include('menu.html');
    ?>

    <!-- MAIN BLOCK START -->

    <h2>FEEDBACK FORM</h2>

    <form class="contact_form" action="contact_form.php" method="post">
        <p>
            <label for="name">Name:</label>
            <input type="text"  name="name" placeholder="Enter Your name" required />
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter Your e-mail" required />
            <span class="form_hint">Correct format "name@something.com"</span>
        </p>
        <p>
            <label for="message">Message:</label>
            <textarea name="message" cols="40" rows="6" required ></textarea>
        </p>
        <p>
            <button class="submit">Send</button>
        </p>
    </form>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>