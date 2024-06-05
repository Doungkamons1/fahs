<?php
  require_once 'db.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO `books`(`name`, `author`, `publish_date`, `total_page`, `price`) VALUES 
    (
      '".$_POST["name"]."',
      '".$_POST["author"]."',
      '".$_POST["publish_date"]."',
      '".$_POST["total_page"]."',
      '".$_POST["price"]."'
    )";

    if ($conn->query($sql) === TRUE) {
      echo "สำเร็จ";
    } else {
      echo "ไม่สำเร็จ: " . $sql . "<br>" . $conn->error;
    }
    header( "refresh:5;url=add.php" );
    exit;
  }
?>

<html>
    <body>
        <h1>เพิ่มหนังสือ</h1>
        <form action="add.php" method="post">
            <label>ชื่อหนังสือ : </label> <input type="text" name="name"><br>
            <label>ผู้เขียน : </label> <input type="text" name="author"><br>
            <label>วันเดือนปีที่พิมพ์ : </label> <input type="date" name="publish_date"><br>
            <label>จำนวนหน้า : </label> <input type="text" name="total_page"><br>
            <label>ราคา : </label> <input type="number" name="price" min="0"><br>
            <button>เพิ่มข้อมูล</button>
        </form>
    </body>
</html>