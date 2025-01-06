<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f9;
            color: #333;
        }
        h1, h2 {
            margin: 20px 0;
        }
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .weekend {
            background-color: #ffdddd;
        }
        .holiday {
            background-color: #ffcccc;
            font-weight: bold;
        }
        tr:hover td {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Календарь</h1>
    <?php
    function printCalendar($month = null, $year = null, $holidays = []) {
        if ($month === null || $year === null) {
            $month = date("n");
            $year = date("Y");
        }

        $daysOfWeek = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date("t", $firstDayOfMonth);
        $dayOfWeek = date("N", $firstDayOfMonth) - 1;

        echo "<h2>{$month}/{$year}</h2>";
        echo "<table>";
        echo "<tr>";
        foreach ($daysOfWeek as $day) {
            echo "<th>{$day}</th>";
        }
        echo "</tr><tr>";

        if ($dayOfWeek > 0) {
            echo str_repeat("<td></td>", $dayOfWeek);
        }

        for ($day = 1; $day <= $numberDays; $day++) {
            $currentDayOfWeek = ($dayOfWeek + $day - 1) % 7;
            $class = "";

            if ($currentDayOfWeek >= 5) {
                $class = "weekend";
            }
            if (in_array($day, $holidays)) {
                $class = "holiday";
            }

            echo "<td class='{$class}'>{$day}</td>";

            if ($currentDayOfWeek == 6) {
                echo "</tr><tr>";
            }
        }

        echo "</tr></table>";
    }

    // Пример использования: праздники - 25-е и 31-е числа
    printCalendar(12, 2024, [25, 31]);
    ?>
</body>
</html>
