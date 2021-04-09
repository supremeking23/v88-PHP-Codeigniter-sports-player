<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a student to all bootcamp courses</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

     <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
</head>
<body>
    
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Add a new course</h2>
                <?php 
                   echo $this->session->flashdata("errors");
                   echo $this->session->flashdata("course-delete");
                ?>
                
                <form action="<?= base_url()?>add" method="POST">
                    <div class="form-group">
                        <label for="course">Course Name</label>
                        <input type="text" class="form-control" id="course" name="course"  placeholder="Enter course name">
                    </div>
                    <div class="form-group">
                        <label for="course-description">Description</label>
                        <textarea class="form-control" id="course-description" name="course-description"  rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div> 

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Courses</h2>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Course Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($courses as $course):
                            // $date_format = date_format($course["created_at"],"F dS, Y");

                            $date = date_create($course["created_at"]);
                            $format_date = date_format($date,"F/d/Y, h:i:s a");
                        ?>
                        <tr>
                            <td><?= $course["title"]?></td>
                            <td><?= $course["description"]?></td>
                            <td><?= $format_date ; ?></td>
                            <td><a href="<?= base_url() ?>destroy/<?= $course["id"]?>">Delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                   
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>