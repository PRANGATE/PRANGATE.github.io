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

	$number = 0;
	$row = 3;
    // Проверяем значение
    if ($scheduleType === 'student') {
		while ($sheet->getCellByColumnAndRow(2, $row)->getValue() !== null) {
			$column = 4;
    		while ($sheet->getCellByColumnAndRow($column, 2)->getValue() !== null){
        		// Получение значения ячейки
        		$cellValue = $sheet->getCellByColumnAndRow($column, $row)->getValue();
	    		// Получение значения до пробела
        		$group = explode(' ', $cellValue)[0];
       			// Вывод значения в <option>
	       		echo "<option value='" . $number . "'>" . $group . "</option>";
       			// Увеличение номера
       			$number++;
        		// Увеличение колонки
        		$column++;
    		}
    		// Переход на следующую строку
    		$row++;
		}
    } elseif ($scheduleType === 'teacher') {
		while ($sheet->getCellByColumnAndRow(2, $row)->getValue() !== null) {
			$column = 4;
    		while ($sheet->getCellByColumnAndRow($column, 2)->getValue() !== null) {
				// Получение значения ячейки
        		$cellValue = $sheet->getCellByColumnAndRow($column, $row)->getValue();
        		// Разделение строки по пробелам
				$parts = explode(' ', $cellValue);
				if (count($parts) >= 3) {
    				$teacherName = $parts[count($parts) - 3] . ' ' . $parts[count($parts) - 2] . ' ' . $parts[count($parts) - 1];
				}
        		// Вывод значения в <option>
            	echo "<option value='" . $number . "'>" . $teacherName . "</option>";
          		// Увеличение номера
           		$number++;
            }
                // Увеличение колонки
                $column++;
        }
        // Переход на следующую строку
        $row++;
    } else {
        echo "<p>Неизвестный выбор</p>";
    }
}
?>