<?php

logout();

unset($_SESSION['user_id']);
unset($_SESSION['timestamp']);

header('Location: /login');
renderView('home_get');