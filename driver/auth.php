<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!Drivers::authenticate()) {
    redirect('index.php');
}