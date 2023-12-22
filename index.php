<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate TOTAL</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="container">
        <h1>Calculate TOTAL</h1>

        <form method="post" action="">
            <input type="text" name="voltage" placeholder="Voltage (V)" required>
            <input type="text" name="current" placeholder="Current (A)" required>
            <input type="text" name="rate" placeholder="Rate (sen/kWh)" required>
            <button type="submit" class="btn">Calculate</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $voltage = isset($_POST['voltage']) ? floatval($_POST['voltage']) : 0;
            $current = isset($_POST['current']) ? floatval($_POST['current']) : 0;
            $rate = isset($_POST['rate']) ? floatval($_POST['rate']) : 0;

            $power = $voltage * $current;
            $rate_per_kwh = $rate / 100; 

            echo "<h2>Results:</h2>";
            echo "<p>Power: " . number_format($power / 1000, 5) . " kW</p>";
            echo "<p>Rate: " . number_format($rate_per_kwh, 3) . " RM</p>";

            echo "<table>";
            echo "<tr><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr>";

            for ($hour = 1; $hour <= 24; $hour++) {
                $energy = $power * $hour / 1000; 
                $total_hour = $energy * $rate_per_kwh;

                echo "<tr>";
                echo "<td>{$hour}</td>";
                echo "<td>" . number_format($energy, 5) . "</td>";
                echo "<td>" . number_format($total_hour, 3) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            
            echo "<p>No results to display. Please submit the form.</p>";
        }
        ?>
    </div>
</body>
</html>
