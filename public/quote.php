<?php

//config 
require("../includes/config.php");

//rendering a page from RENDER function
render("quote_form.php", ["title" => "Get the Bitch"]);

$stock = lookup($_POST["symbol"]);




?>
