<?php

logout();

unset($_SESSION['user_id']);
unset($_SESSION['timestamp']);

renderView('home_get');