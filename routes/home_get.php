<?php

if (isset($_GET['keyword'])) {
    $result = getCoursesByKeyword($_GET['keyword']);
} else {
    $result = getCourses();
}

renderView('home_get', ['courses' => $result]);