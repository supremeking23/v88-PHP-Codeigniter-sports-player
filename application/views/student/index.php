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
    <div class="container">
       
       
        <form action="<?= base_url()?>login" method="POST">
            <h2>Login</h2>
            <?= $this->session->flashdata("log_in_errors"); ?>
            <label for="email">Email Address: 
                <input type="text" name="email" id="email" value="">
            </label>

            <label for="password">Password: 
                <input type="password" name="password" id="password" value="">
            </label>

            <input type="submit" value="Login">
            <div class="clearfix"></div>
        </form>  
    </div>

    <div class="container">
        
       
        <form action="<?= base_url()?>register" method="POST">
            <h2>Register</h2>

                <?= $this->session->flashdata("errors"); ?>
                <?= $this->session->flashdata("add-student-success"); ?>

                <label for="email">First Name: 
                    <input type="text" class="student-name" name="first-name" id="first-name" value="">
                </label>

                <label for="email">Last Name: 
                    <input type="text" class="student-name" name="last-name" id="last-name" value="">
                </label>


                <label for="email">Email Address: 
                    <input type="text" name="email" id="email" value="">
                </label>

                <label for="password">Password: 
                    <input type="password" name="password" id="password" value="">
                </label>

                <label for="password">Confirm Password: 
                    <input type="password" class="confirm-password" name="confirm-password" id="confirm-password" value="">
                </label>

                <input type="submit" value="Register">
                <div class="clearfix"></div>
        </form>  
    </div>
</body>
</html>