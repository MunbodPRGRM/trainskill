<?php

$result = getTrainingByUserId($_SESSION['user_id']);

renderView('notification_get', ['training' => $result]);