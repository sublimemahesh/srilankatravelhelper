<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

$DRIVER = new Drivers(NULL);

if ($DRIVER->logOut()) {
    header('Location: ../index.php');
} else {
    header('Location: ./?error=2');
}

