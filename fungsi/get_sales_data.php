<?php
include '../config.php';

header('Content-Type: application/json');

$type = $_GET['type'] ?? 'daily';
$month = $_GET['month'] ?? date('n');
$year = $_GET['year'] ?? date('Y');
$data = ['labels' => [], 'values' => []];

try {
    switch($type) {
        case 'daily':
            // Query untuk data harian dalam bulan tertentu
            $query = "SELECT 
                        DATE(tanggal_input) as date,
                        SUM(total) as total
                    FROM nota 
                    WHERE MONTH(tanggal_input) = ?
                    AND YEAR(tanggal_input) = ?
                    GROUP BY DATE(tanggal_input)
                    ORDER BY date ASC";
            
            $stmt = $config->prepare($query);
            $stmt->execute([$month, $year]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Inisialisasi array untuk semua hari dalam bulan
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            for($i = 1; $i <= $daysInMonth; $i++) {
                $date = sprintf('%04d-%02d-%02d', $year, $month, $i);
                $data['labels'][] = date('d M Y', strtotime($date));
                $data['values'][] = 0;
            }

            // Isi data dari database
            foreach($results as $row) {
                $day = (int)date('j', strtotime($row['date'])) - 1;
                $data['values'][$day] = (float)$row['total'];
            }
            break;

        case 'monthly':
            // Query untuk data bulanan dalam tahun tertentu
            $query = "SELECT 
                        MONTH(tanggal_input) as month,
                        SUM(total) as total
                    FROM nota 
                    WHERE YEAR(tanggal_input) = ?
                    GROUP BY MONTH(tanggal_input)
                    ORDER BY month ASC";
            
            $stmt = $config->prepare($query);
            $stmt->execute([$year]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Inisialisasi data untuk semua bulan
            foreach($months as $index => $monthName) {
                $data['labels'][] = $monthName;
                $data['values'][] = 0;
            }

            // Isi data dari database
            foreach($results as $row) {
                $monthIndex = $row['month'] - 1;
                $data['values'][$monthIndex] = (float)$row['total'];
            }
            break;

        case 'yearly':
            // Query untuk data tahunan
            $query = "SELECT 
                        YEAR(tanggal_input) as year,
                        SUM(total) as total
                    FROM nota 
                    GROUP BY YEAR(tanggal_input)
                    ORDER BY year ASC";
            
            $stmt = $config->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($results as $row) {
                $data['labels'][] = $row['year'];
                $data['values'][] = (float)$row['total'];
            }
            break;
    }

    echo json_encode($data);

} catch (Exception $e) {
    error_log('Error in get_sales_data.php: ' . $e->getMessage());
    echo json_encode([
        'error' => $e->getMessage(),
        'labels' => [],
        'values' => []
    ]);
}
?> 