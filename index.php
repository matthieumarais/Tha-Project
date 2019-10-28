<?php
        /*  phpinfo();
        die(); */
        include_once 'functions/functions.php';
        include_once 'config/config.php';

        include 'header.php';

        
    ?>

<main>

<?php
    if (!isset($_GET['page']) || empty($_GET['page'])):

            include 'pages/accueil.php';

        elseif (isset($_GET['page']) && file_exists('pages/' . $_GET['page'] . '.php')):

            include "pages/{$_GET['page']}.php";

        else:

            include 'pages/404.php';

        endif;

        if(empty($_GET['page']) || (!empty($_GET['page']) && $_GET['page'] != "ficheTechnique")) {
            include 'footer.php';                    
        }
