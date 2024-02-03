<?php
require_once("connect.php");
if (isset($_REQUEST['delete_id'])){
    $id = $_REQUEST['delete_id'];
     $select_stmt = $dbcon->prepare("SELECT * FROM product WHERE id = :id");
     $select_stmt -> bindparam(':id',$id);
     $select_stmt ->execute();
     $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    
     $delete_stmt = $dbcon->prepare("DELETE FROM product WHERE id = :id ");
     $delete_stmt->bindparam(':id',$id);
     $delete_stmt->execute();
      
     header('location:index.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <div class="container">
  
        <div class="display-3 text-center">backend</div>
        <a href="add.php " class="btn btn-success mb-3">Add+</a>
   
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>product_name</th>
                <th>product_price</th>
                <th>QTY</th>
                <th>Record_datetime</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_stmt = $dbcon->prepare("SELECT * FROM product");
            $select_stmt->execute();
            while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row["product_name"];?></td>
                <td><?php echo $row["product_price"];?></td>
                <td><?php echo $row["QTY"];?></td>
                <td><?php echo $row["Record_datetime"];?></td>
                <td> <a href="edit.php?update_id=<?php echo $row["id"];?>" class="btn btn-warning">Edit</a></td>
                <td> <a href="?delete_id=<?php echo $row["id"];?>" class="btn btn-danger">Delete</a></td>
            </tr>

            <?php } ?>
        </tbody>
    </table>

    </div>
</body>
</html>