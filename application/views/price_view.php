<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
</head>
<body>
<?php echo $cart; ?>
<div class="container-fluid">
<?php echo $banner_menu; ?>

<div class="row">
    <div class="col-xxs-12">
        <div class="container">
            <div class="row">
<?php foreach($bills as $key=>$value):?>
            <p>
                <p><?php echo $key; ?></p>
                <p>
                    <p style="margin-left:30px;"><?php echo $value["customerEmail"]; ?></p>
                    <p style="margin-left:30px;"><?php echo $value["customerName"]; ?></p>
                    <p style="margin-left:30px;"><?php echo $value["customerPhone"]; ?></p>
                    <p style="margin-left:30px;"><?php echo $value["shipAddress"]; ?></p>
                </p>
                <p>
                    <p style="margin-left:30px;">
                        Chi tiết:
<?php foreach($value["listProducts"] as $row): ?>
                        <p style="margin-left:60px;"><?php echo $row["name"]; ?> : <?php echo $row["amount"]; ?></p>
<?php endforeach; ?>
                    </p>
                </p>
            </p>
<?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
</div>

</body>
</html>
