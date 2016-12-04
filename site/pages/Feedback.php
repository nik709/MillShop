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
    session_start();
    include('menu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <div class="page-title-wrapper">
        <div class="page-title">Contact us</div>
    </div>

    <div id="contact-form-wrapper">
        <div id="contact-us">
            <form method="post" action="contact_form.php" class="contact-form">
                <input type="text" class="simple-textbox contact-form-textbox" name="name" placeholder="Your Name" required />
                <input type="email" class="simple-textbox contact-form-textbox" name="email" placeholder="Your e-Mail" required />
                <span class="form-hint">Incorrect format</span>
                <textarea type="text" class="simple-textbox contact-form-textbox contact-form-textarea" name="message" placeholder="Your Message" cols="40" rows="6"></textarea>
                <button class="simple-button contact-form-button">SEND</button>
            </form>
        </div>

        <div id="contact-us-banner">
            <img src="../resources/images/banners/banner_40005.jpg">
            <div id="contact-us-banner-text">Shop More with Mill Shop!</div>
        </div>
    </div>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>