<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop - Kids</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
    <script>
        function process(str) {
            if(str == "") {
                document.getElementById("tmp").innerHTML = "";
            } else {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("tmp").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "Search.php?search=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
    <?php
    session_start();
    include('menu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <h1>Clothes for KIDS</h1>

    <form>
        <input type="text" onkeyup="process(this.value)"/>
    </form>
    <div id="tmp">Text from search</div>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>