<?php
// Подключение PHPExcel вручную
require_once 'PHPExcel.php';

// Проверка метода запроса
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Получение данных из формы
    $scheduleType = $_GET['scheduleType'];
    $group = $_GET['Group'];
    $selectedDay = $_GET['selectedDay'];

    // Путь к вашему Excel-файлу
    $filePath = 'Форма расписания  2 семестр 24-25г.xlsx';

    // Загрузка Excel-файла с помощью PHPExcel
    try {
        $inputFileType = PHPExcel_IOFactory::identify($filePath);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($filePath);
    } catch (Exception $e) {
        die('Ошибка при загрузке файла: ' . $e->getMessage());
    }

    // Получение активного листа
    $sheet = $objPHPExcel->getActiveSheet();

    // Пример: вывод данных из диапазона A1:D10
    $range = 'A1:D106'; // Укажите нужный диапазон
    $dataArray = $sheet->rangeToArray($range);
    $error = 0;
    // Вывод данных в виде HTML-таблицы
    if ($group === student){
        echo "<h2>Расписание для группы $group</h2>";
    } elseif ($scheduleType === 'teacher') {
        echo "<h2>Расписание для преподавателя $group</h2>";
    } else {
        echo "<h2>Ошибка</h2>";
        $error = 1;
    }
    if ($error === 0) {
        echo "<table>";
        foreach ($dataArray as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td rowspan=\"2\">$cell</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}
//<td rowspan=\"2\"> соединение снизу
//<td colspan=\"2\"> соединение с права
?>