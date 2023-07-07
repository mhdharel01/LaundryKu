<?php
session_start();
session_destroy();


header("Location: pages/login/loginv2.php");
