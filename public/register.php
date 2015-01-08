<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must provide your password confirmaton.");
        }
        else if ($_POST["password"] !== $_POST["confirmation"])
        {
            apologize("Password do not match");
        }
        else
        {
           //check if user already exist in the database
           $result = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
           if ($result === false)
            {
            apologize("The username already exist.");
            }
            else
            {
            //if succeeds, add user into the database
            query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)", $_POST["username"], crypt($_POST["password"]));
            }
            
            //retrive user's id
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            
            //remember that user alreay logged in
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            
            //redirect to portfoli page (index.php)
            redirect("index.php");
        }
    }

?>
