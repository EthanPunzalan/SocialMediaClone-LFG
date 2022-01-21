<?php

    $db = mysqli_connect("localhost","ethanpunzalan1700","jelly1700","lfg_db");
        if(!$db){
            die("Connection Failed".mysqli_connect_error());
        }