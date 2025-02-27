<?php

function getCourses(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = '
        SELECT c.*, u.user_name 
        FROM courses c
        INNER JOIN users u ON c.user_id = u.user_id
    ';
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result;
}

