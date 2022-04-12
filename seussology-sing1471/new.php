<?php
require_once "db.php";
  if(isset($_POST['book_title'])){
    $sql="INSERT INTO books (book_title, book_title_sort, book_year, book_description, book_pages) VALUES (:book_title, :book_title_sort, :book_year, :book_description, :book_pages)";
    $stmt=$db->prepare($sql);
    $stmt->execute([
      ":book_title" => $_POST['book_title'],
      ":book_title_sort" => $_POST['book_title_sort'],
      ":book_year" => $_POST['book_year'],
      ":book_description" => $_POST['book_description'],
      ":book_pages" => $_POST['book_pages']

    ]);
  if($stmt->rowCount()){
    header("Location: book.php?id={$db->lastInsertId()}");
  }
  }


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seussology</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
  <?php include 'header.php'; ?> 
  <h1 class="page-title">Add Book</h1>
    <section class="edit-book">
            
<form class="book-form" method="post">
  <div class="form-row">
    <div class="col-12 mb-3">
      <label>Title</label>
      <input type="text" class="form-control" name="book_title" id="" value=""required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-12 mb-3">
      <label>Sort Title</label>
      <input type="text" class="form-control" name="book_title_sort" id="" value="">
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label>Published Year</label>
      <input type="number" class="form-control" name="book_year" value="" min="1900" max="2022" required>
    </div>
    <div class="col-md-6 mb-3">
      <label>Number of Pages</label>
      <input type="number" class="form-control" name="book_pages" value="" min="01">
    </div>
  </div>
  <div class="form-row">
    <div class="col-12 mb-3">
      <label>Book Description</label>
      <textarea name="book_description" class="form-control" required></textarea>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Add Book</button>
</form>    </section>
  </main>
</body>

</html>