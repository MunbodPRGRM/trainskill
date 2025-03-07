<?php

$result = getUserById($_SESSION['user_id']);

renderView('profile_edit_get', ['result' => $result]);