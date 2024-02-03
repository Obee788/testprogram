<?php
require_once("connect.php");
if (isset($_REQUEST['update_id'])){
    try{
        $id =$_REQUEST ['update_id'];
        $select_stmt = $dbcon->prepare("SELECT * FROM product WHERE id = :id");
        $select_stmt->bindparam(':id',$id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);

    } catch (PDOException $e ) {
        $e->getMessage();
    }
}
if (isset($_REQUEST['btn_update'])) {
    $Re= $_REQUEST['txt_Record_datetime'];

    date_default_timezone_set('Asia/Bangkok');
    $date_nows = date(' H:i:s');
    $date_news = $Re . $date_nows;

    $product_name= $_REQUEST['txt_product_name'];
    $product_price= $_REQUEST['txt_product_price'];
    $QTY= $_REQUEST['txt_QTY'];
    
    $Record_datetime= $date_news;

    if (empty($product_name)) {
        $errormsg = "ໃສ່ຊື້ສີນຄ້າກ່ອນ";
    } else if (empty($product_price)) {
        $errormsg = "ໃສ່ລາຄາສີນຄ້າກ່ອນ";
    } else {
        try {
            if (!isset($errormsg)) {
                $insert_stmt = $dbcon->prepare("UPDATE product SET product_name=:product_name,product_price=:product_price,QTY=:QTY,Record_datetime=:Record_datetime WHERE id=:id");
                $insert_stmt->bindparam(':product_name',$product_name);
                $insert_stmt->bindparam(':product_price',$product_price);
                $insert_stmt->bindparam(':QTY',$QTY);
                $insert_stmt->bindparam(':Record_datetime',$Record_datetime);
                $insert_stmt->bindparam(':id',$id);

                if ($insert_stmt->execute()) {
                    $insertmsg ="ບັນທືກສຳເລັດ";
                    header("refresh:2;index.php");

                }

            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <div class="display-3 text-center">ແກ້ໄຂຂໍ້ມູນສີນຄ້າ</div>
        <?php if (isset($errormsg)) {
        ?>
        <div class="alert alert-danger">
            <strong>wrong! <?php echo $errormsg; ?></strong>
        </div>
        <?php } ?>
        <?php if (isset($insertmsg)) {
        ?>
        <div class="alert alert-success">
            <strong>success <?php echo $insertmsg; ?></strong>
        </div>
        <?php } ?>
         <div class="fedit">
        <form method="POST" class="form-horisontal">
            <div class="form-group">
                <label for="product_name" class="col-sm3 contro-lable">product_name</label>
                <div class="col-sm6">
                    <input type="text" name="txt_product_name" class="form-contro" VALUE="<?php echo $product_name; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="product_price" class="col-sm3 contro-lable">product_price</label>
                <div class="col-sm6">
                    <input type="text" name="txt_product_price" class="form-contro" VALUE="<?php echo $product_price; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="QTY" class="col-sm3 contro-lable">QTY</label>
                <div class="col-sm6">
                    <input type="text" name="txt_QTY" class="form-contro" VALUE="<?php echo $QTY; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="Record_datetime" class="col-sm3 contro-lable">Record_datetime</label>
                <div class="col-sm6">
                    <input type="date"  name="txt_Record_datetime" class="form-contro" VALUE="<?php echo $Record_datetime; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 mt-5" id="bedit">
                    <input type="submit" name="btn_update" class="btn btn-success" value="Update">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</body>
</html>