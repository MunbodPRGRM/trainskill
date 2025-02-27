<?php

$result = getCourses();

renderView('home_get', ['courses' => $result]);