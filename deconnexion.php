<?php

session_start();

session_destroy();

//redirection
header('Location: session.php');
