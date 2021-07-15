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

/**
 * 
 * @return bool если sql запрос вернул ошибку, значит таблица не создана
 */
function is_table_exists($mysqli){
    return mysqli_query($mysqli, "SELECT * FROM history");
  }

function create_table($mysqli){
    $sql = "CREATE TABLE `log`.`history` ( `id` INT NOT NULL AUTO_INCREMENT , `expression` VARCHAR(255) NOT NULL , `success` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    return mysqli_query($mysqli, $sql);
}