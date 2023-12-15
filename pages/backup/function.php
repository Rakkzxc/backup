<?php
if (!isset($_SESSION)) {
  session_start();
  if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
    exit();
  } elseif (($_SESSION['role'] !== "administrator") || ($_SESSION['role'] === "resident") || ($_SESSION['role'] === "staff") || ($_SESSION['role'] === "captain")) {
    header("Location: ../../login.php");
    exit();
  } else {
    include "../connection.php";

    $tables = array();
    $sql = "SHOW TABLES";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_row($result)) {
      $tables[] = $row[0];
    }

    $sqlScript = "";
    foreach ($tables as $table) {
      $query = "SHOW CREATE TABLE " . mysqli_real_escape_string($con, $table);
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_row($result);
      $sqlScript .= "\n\n" . $row[1] . ";\n\n";
      $query = "SELECT * FROM " . mysqli_real_escape_string($con, $table);
      $result = mysqli_query($con, $query);
      $columnCount = mysqli_num_fields($result);

      for ($i = 0; $i < $columnCount; $i++) {
        while ($row = mysqli_fetch_row($result)) {
          $sqlScript .= "INSERT INTO " . mysqli_real_escape_string($con, $table) . " VALUES(";
          for ($j = 0; $j < $columnCount; $j++) {
            if (isset($row[$j])) {
              $sqlScript .= '"' . mysqli_real_escape_string($con, $row[$j]) . '"';
            } else {
              $sqlScript .= '""';
            }
            if ($j < ($columnCount - 1)) {
              $sqlScript .= ',';
            }
          }
          $sqlScript .= ");\n";
        }
      }
      $sqlScript .= "\n";
    }

    if (!empty($sqlScript)) {
      // get the current date and time in a specific format (e.g., YYYY-MM-DD_His)
      $currentDatetime = date('Y-m-d__H-i-s');
      // need to debug to get the _backup_2023-10-18_06:40:48
      // backup name: _backup_
      // current date: 2023-10-18
      // current time: 18-40-48 (hour-minutes-seconds)

      // sanitize the database name for the backup file
      $safeDatabaseName = preg_replace('/[^a-zA-Z0-9_]/', '', $database_name);
      $backup_file_name = $safeDatabaseName . 'backup__' . $currentDatetime . '.sql';
      $backup_path = '/' . $backup_file_name;
      $fileHandler = fopen($backup_path, 'w+');

      if ($fileHandler) {
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler);

        // download the SQL backup file to the browser
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_path));
        ob_clean();
        flush();
        readfile($backup_path);

        // securely delete the backup file
        unlink($backup_path);
      } else {
        echo "Failed to create the backup file.";
      }
    } else {
      echo "No data to backup.";
    }
  }
} ?>