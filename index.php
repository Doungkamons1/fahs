<?php
    require_once 'db.php';
    
    $where = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_POST["name"]!==""){
            $where .= " name LIKE '%".$_POST["name"]."%' ";
        }

        if($_POST["author"]!==""){
            if($where!==""){
                $where .= " AND ";
            }
            $where .= " author LIKE '%".$_POST["author"]."%' ";
        }

        if($_POST["price"]!==""){
            if($where!==""){
                $where .= " AND ";
            }
            $where .= " price <= ".$_POST["price"]." ";
        }
    }

    if($where === ""){
        $where = " 1 ";
    }
    
    $sql = "SELECT * FROM `books` WHERE ".$where." ORDER BY price DESC";
    $result = $conn->query($sql);

?>
<html>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
    <body>
        <h1>แสดงผลข้อมูลหนังสือ</h1>
        <form action="index.php" method="post">
            <label>ชื่อหนังสือ : </label> <input type="text" name="name" value="<?=$_POST["name"]?>">
            <label>ผู้เขียน : </label> <input type="text" name="author" value="<?=$_POST["author"]?>">
            <label>ราคา : </label> <input type="number" name="price" min="0" value="<?=$_POST["price"]?>">
            <button>ค้นหา</button>
        </form>
        <table>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อหนังสือ</th>
                <th>ผู้เขียน</th>
                <th>วันเดือนปีที่พิมพ์</th>
                <th>จำนวนหน้า</th>
                <th>ราคา</th>
            </tr>
            <?php
                if ($result->num_rows > 0) {
                    $number = 1;
                    while($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?=$number++?></td>
                    <td><?=$row["name"]?></td>
                    <td><?=$row["author"]?></td>
                    <td><?=$row["publish_date"]?></td>
                    <td><?=$row["total_page"]?></td>
                    <td><?=$row["price"]?></td>
                </tr>
            <?php
                    }
                }else{
            ?>
                <tr>
                    <td colspan="6">ไม่เจอข้อมูล</td>
                </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>