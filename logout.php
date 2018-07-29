<?php

include_once('app/core/init.php');
session_destroy();
header('Location: ' . ROOT . 'login.php');