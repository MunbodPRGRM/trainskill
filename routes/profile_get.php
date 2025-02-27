<?php

$result = getUserById($_SESSION['user_id']);

renderView('profile_get', ['result' => $result]);