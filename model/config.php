<?php
global $conn;
  // Hàm này quản lý việc kết nối với csdl
  function pdo_con(){
    global $conn;

    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
      // Tạo đối tượng kết nối 
      $conn = new PDO("mysql:host=$servername;dbname=testdien", $username, $password);
      // set the PDO error mode to exception
      //Thiết lập chế độc hiển thị lỗi
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Cho phép đọc ghi dữ liệu unicode utf8
      $conn -> query("SET NAMES 'utf8'");
      // Trả về đối tượng kết nối
      return $conn;
    } catch(PDOException $e) {
      echo "Lỗi kết nối: " . $e->getMessage();
    }
  }

  // Chạy câu truy vấn
  function pdo_execute($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = pdo_con();
      $stmt = $conn->prepare($sql);
      $stmt -> execute($sql_args);
    } catch (PDOException $e) {
      throw $e;
    }finally{
      unset($conn);
    }
  }

  // Chạy câu truy vấn có lấy về danh sách kết quả
  function pdo_query($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = pdo_con();
      $stmt = $conn->prepare($sql);
      $stmt -> execute($sql_args);
      $rows = $stmt->fetchAll();
      return $rows;
    } catch (PDOException $e) {
      throw $e;
    }finally{
      unset($conn);
    }
  }


  // Chạy câu truy vấn và lấy ra dòng đầu tiên của kết quả
  // 
  function pdo_query_one($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try {
      $conn = pdo_con();
      $stmt = $conn->prepare($sql);
      $stmt -> execute($sql_args);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row;
    } catch (PDOException $e) {
      throw $e;
    }finally{
      unset($conn);
    }
  }

  function pdo_get_last_insert_id() {
    global $conn;
    return $conn->lastInsertId();
  }
?>