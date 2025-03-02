<?php

$result = getCourseById($_GET['id']);

renderView('course_get', ['courses' => $result]);