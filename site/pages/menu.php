<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 -->
<script type="text/javascript">
    function onSubmitSearch() {
        var text = document.getElementById("search-textbox").value;
        if(text != "") {
            document.searchForm.action = "Search.php?search=" + text;
            return true;
        }
        return false;
    }
</script>

<div id="wrapping-block">
    <div id="menu-block">
        <div id="logo-block">
            <a href="MillShop.php"><div id="logo-image"></div></a>
        </div>
        <div id="menu-bar-outside">
            <div id="menu-bar-inside">
                <div class="margin-wrapper">
                    <div id="menu-bar-links">
                        <div class="menu-links-item"><a href="Men.php">Men</a></div>
                        <div class="menu-links-item"><a href="Women.php" class="menu-links-item">Women</a></div>
                        <div class="menu-links-item"><a href="Kids.php" class="menu-links-item">Kids</a></div>
                    </div>
                    <div id="menu-bar-tools">
                        <div id="menu-bar-search">
                            <form id="search-form" name="searchForm" class="search-form" title="Search" method="get" onsubmit="return onSubmitSearch();">
                                <input type="text" class="search-textbox" placeholder="I'm looking for..." id="search-textbox" name="search" value="" autocomplete="off">
                                <input type="submit" class="search-button" value="">
                                <span class="search-icon"></span>
                            </form>
                        </div>
                        <a href="MillShop.php" style="text-decoration: none">
                            <div id="menu-bar-currency" title="Currency"></div>
                        </a>
                        <a href="login.php" style="text-decoration: none">
                            <div id="menu-bar-user" title="My profile"></div>
                        </a>
                        <a href="MillShop.php">
                            <div id="menu-bar-bag" title="My bag"><div id="menu-bag-items-count"><?php echo $_SESSION['count'];?></div></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="main-block">
        <div class="margin-wrapper">
            <!--</div>
        </div>
    </div> -->