<?php

$result = getCourseById($_GET['id']);

renderView('course_edit_get', ['course' => $result]);