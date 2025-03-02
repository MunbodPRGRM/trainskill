<?php

$result = getTrainingByCourseId($_GET['id']);

renderView('course_participant_get', ['training' => $result]);