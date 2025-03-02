<?php

$result = getTrainingByUserId($_SESSION['user_id']);

renderView('history_get', ['training' => $result]);