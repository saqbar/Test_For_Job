<?php
include 'env.php';

switch ($_REQUEST['data']){
    case  null:
        echo 'арифметическое выражение не найденно';
        break;
    case strlen($_REQUEST['data']) <= 6:
        echo 'арифметическое выражение не верно';
        break;
    default:
        $req = $_REQUEST['data'];
        // проверка на одинарное количество вхождений [({123123})]
        $x = strrpos($req, '[({');
        $y = strrpos($req, '})]');
        $countX = substr_count($req, '[({');
        $countY = substr_count($req, '})]');
        if ($x === false || $y === false){
            echo 'Не верно';
        }else{
            // проверка на количество вхождений больше 1 [({123[({12312})]33123})]
            // в случае если скобки открываются , но не закрываются выводится 'Не верно'
            if ($countX > 1 || $countY > 1){
                if ($countX === $countY){
                    echo 'Верно';
                }else {
                    echo 'Не верно';
                }
            }else{
                echo 'Верно';
            }
        }
}

echo '<hr>';


// поиск неуникальных значений id
$query = "SELECT id, COUNT(*) as count FROM CREATE_TABLE GROUP BY id HAVING count > 1";

if ($result = $connectBD->query($query)) {
    // Обработка результатов запроса
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Найдено неуникальное значение id: " . $row["id"] . ", количество вхождений: " . $row["count"] . "<br>";
        }
    } else {
        echo "Все значения id уникальны";
    }
    $result->free();
} else {
    echo "Ошибка запроса: " . $connectBD->error;
}

// Закрытие соединения с базой данных
$connectBD->close();


