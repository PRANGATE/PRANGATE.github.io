<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Расписание ВГУВТ</title>
	<link href="style.css" rel="stylesheet">
	<style>
        body {
		font-family: Arial, sans-serif;
		background-color: #ffffff;
        }
        .container {
		max-width: 600px;
    	margin: 50px auto;
    	padding: 20px;
    	}
    	h1 {
			text-align: center;
			color: #333;
		}
		.form-group {
			margin-bottom: 20px;
		}
        select {
         	width: 100%;
        	padding: 8px;
        	margin-bottom: 10px;
        	border: 1px solid #ddd;
    		border-radius: 4px;
        }
        button {
        	background-color: #007bff;
            color: white;
        	border: none;
        	padding: 8px 20px;
        	border-radius: 4px;
        	cursor: pointer;
        }
        .days-select {
      	margin-bottom: 20px;
    	}
	</style>
</head>
<body>
    <div class="container">
        <h1>Выбор расписания</h1>
        <form id="scheduleForm" method="GET">
            <div class="form-group">
                <label for="scheduleType">Для кого расписание</label>
                <select name="scheduleType" id="scheduleType">
                    <option value="student" selected>Расписание студентов</option>
                    <option value="teacher">Расписание преподавателей</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Group">Выберите группу / преподавателя:</label>
                <select name="Group" id="Group">
                    <?php include 'ScriptWhy.php'; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="selectedDay">Выберите тип расписания:</label>
                <select name="selectedDay" id="selectedDay">
                    <option value="Current" selected>Расписание текущей недели</option>
                    <option value="Full">Полное расписание группы</option>
                </select>
            </div>
            <button type="submit">Посмотреть расписание</button>
        </form>
    </div>
</body>
</html>