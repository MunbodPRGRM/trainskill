<?php

$result = getCourseByUserId($_SESSION['user_id']);

renderView('course_own_get', ['courses' => $result]);