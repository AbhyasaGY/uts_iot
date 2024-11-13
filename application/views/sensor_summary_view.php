<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sensor Data Dashboard Abhyasa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles for the dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-container {
            width: 100%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #4CAF50;
        }
        .summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .summary-card {
            background-color: #f4f7f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            width: 30%;
            text-align: center;
        }
        .summary-card h2 {
            font-size: 20px;
            margin: 0;
        }
        .summary-card p {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .data-section {
            margin-top: 20px;
        }
        .data-section h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }
        .data-section ul {
            list-style: none;
            padding: 0;
        }
        .data-section ul li {
            padding: 8px;
            background: #f9f9f9;
            margin: 5px 0;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="dashboard-container">
    <div class="header">
        <h1>Sensor Data Dashboard Abhyasa</h1>
        <p>Overview of maximum, minimum, and average values</p>
    </div>

    <div class="summary">
        <div class="summary-card" id="maxTemp">
            <h2>Max Temperature</h2>
            <p>Loading...</p>
        </div>
        <div class="summary-card" id="minTemp">
            <h2>Min Temperature</h2>
            <p>Loading...</p>
        </div>
        <div class="summary-card" id="avgTemp">
            <h2>Average Temperature</h2>
            <p>Loading...</p>
        </div>
    </div>

    <div class="data-section">
        <h2>Records with Max Temperature and Humidity</h2>
        <ul id="maxTempHumidData">
            <li>Loading...</li>
        </ul>
    </div>

    <div class="data-section">
        <h2>Month-Year with Max Temperature and Humidity</h2>
        <ul id="monthYearMax">
            <li>Loading...</li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Fetch data from the API and update the dashboard
        $.getJSON("http://localhost/uts_iot/api/sensor_summary", function(data) {
            // Display max, min, and average temperature
            $('#maxTemp p').text(data.suhumax + ' °C');
            $('#minTemp p').text(data.suhumin + ' °C');
            $('#avgTemp p').text(data.suhurata + ' °C');

            // Display records with max temperature and humidity
            let maxTempHumidHtml = '';
            data.nilai_suhu_max_humid_max.forEach(function(record) {
                maxTempHumidHtml += `<li><strong>Idx:</strong> ${record.idx}, <strong>Temperature:</strong> ${record.suhun} °C, <strong>Humidity:</strong> ${record.humid} %, <strong>Brightness:</strong> ${record.kecerahan}, <strong>Timestamp:</strong> ${record.timestamp}</li>`;
            });
            $('#maxTempHumidData').html(maxTempHumidHtml);

            // Display month-year with max temperature and humidity
            let monthYearMaxHtml = '';
            data.month_year_max.forEach(function(record) {
                monthYearMaxHtml += `<li>${record.month_year}</li>`;    
            });
            $('#monthYearMax').html(monthYearMaxHtml);
        });
    });
</script>

</body>
</html>
