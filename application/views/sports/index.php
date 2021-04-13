<?php 
// $data = $this->session->userdata("sports");
// var_dump($data[1]);

$gender = $this->session->userdata("gender");
$sports_id = $this->session->userdata("sports");
// in_array("female", $gender) ? "checked" : ""
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Player CI</title>
    <link rel="stylesheet/less" type="text/css" href="<?= base_url()?>assets/less/styles.less" />
    <script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
</head>
<body>
    <div class="container">
        
            <form action="<?= base_url() ?>sports/search_process" method="POST">
                <label for="name">
                    Search Users
                    <input type="text" name="name" id="name" value="<?= $this->session->name;?>" placeholder="Search user">
                </label>

                <label for="female">
                   Female <input type="checkbox" name="gender[]" <?= ((is_null($gender)) ? "" : (in_array("female", $gender) ? "checked" : "")) ?> id="gender" value="female">
                </label>
                <label for="male">
                   Male <input type="checkbox" name="gender[]" <?= ((is_null($gender)) ? "" : (in_array("male", $gender) ? "checked" : "")) ?> id="gender" value="male">
                </label>

                <h2>Sports</h2>
<?php foreach($sports as $sport):?>
                <label for="<?=$sport['name']?>">
                   <?=$sport['name']?> <input type="checkbox" name="sports[]" <?= ((is_null($sports_id)) ? "" : (in_array($sport['id'], $sports_id) ? "checked" : "")) ?> id="<?=$sport['name']?>" value="<?=$sport['id']?>">
                </label>
<?php endforeach;?>


                <input type="submit" value="Search">
            </form>
        

        <div class="main-content">
<?php foreach($users as $player):?>
            <div>
                <img src="<?= $player["image_url"]?>" alt="<?= $player["name"]?>">
                <p><?= $player["name"]?></p>
            </div>
<?php endforeach;?>


        </div>
        <div class="clearfix"></div>
    </div>
</body>
</html>