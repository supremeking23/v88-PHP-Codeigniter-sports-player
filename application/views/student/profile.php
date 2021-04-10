<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet/less" type="text/css" href="<?= base_url();?>assets/less/styles.less" />
    <script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
    <style>
        body * {
            /* outline:1px dashed red; */
        }
        .clearfix{
            clear:both;
        }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <h1>Welcome <?= $this->session->student_firstname; ?></h1>
            <a href="<?= base_url();?>students/logout">Log Off</a>
        </div>
    </nav>
   
    <div class="container">
        <section>
            <p> First Name: <span><?= $this->session->student_firstname; ?></span></p>
            <p> Last Name: <span><?= $this->session->student_lastname; ?></span></p>
            <p> Email: <span><?= $this->session->student_email; ?></span></p>
        </section>
    </div>
</body>
</html>