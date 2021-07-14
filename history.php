<?php
//Получить все записи истории из БД
function get_history($db){
    $sql = "SELECT * FROM `history`";

    $result = mysqli_query($db, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $data;
}
//Отправить историю в БД
function insert_history($mysqli, $query){
    return mysqli_query($mysqli, $query);
}