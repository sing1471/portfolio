<?php 
require_once "db.php";

if(isset($_POST['book_title'])){

    $sql='SELECT * FROM books WHERE book_id=:book_id';
    $stmt=$db->prepare($sql);
    $stmt->bindValue(':book_id', $_GET['id']);
    $stmt->execute();
    $book=$stmt->fetch();

    $sql="UPDATE books SET 
    book_title= :book_title,
    book_title_sort= :book_title_sort,
    book_year= :book_year,
    book_description= :book_description,
    book_pages= :book_pages 
    WHERE book_id= :book_id";
    
    $stmt=$db->prepare($sql);
    $stmt->execute([
      ":book_title" => $_POST['book_title'],
      ":book_title_sort" => $_POST['book_title_sort'],
      ":book_year" => $_POST['book_year'],
      ":book_description" => $_POST['book_description'],
      ":book_pages" => $_POST['book_pages'],
      ":book_id"=> $book['book_id']

    ]);
  if($stmt->rowCount()){
    header("Location: book.php?id={$book['book_id']}");
  }
  }


if(isset($_GET['id'])){
    $sql='SELECT * FROM books WHERE book_id=:book_id';
  $stmt=$db->prepare($sql);
  $stmt->bindValue(':book_id', $_GET['id']);
  $stmt->execute();
  $book=$stmt->fetch();

}
else{
    header ('Location: index.php');
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
  <main class="edit">
  <?php include 'header.php'; ?>  
  
  <h1 class="page-title">Edit Book</h1>
    <section class="edit-book">
            
<form class="book-form" method="post">
  <div class="form-row">
    <div class="col-12 mb-3">
      <label>Title</label>
      <input type="text" class="form-control" name="book_title" id="" value="<?php echo $book['book_title']; ?>">
    </div>
  </div>

  <div class="form-row">
    <div class="col-12 mb-3">
      <label>Sort Title</label>
      <input type="text" class="form-control" name="book_title_sort" id="" value="<?php echo $book['book_title_sort']; ?>">
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label>Published Year</label>
      <input type="text" class="form-control" name="book_year" value="<?php echo $book['book_year']; ?>">
    </div>
    <div class="col-md-6 mb-3">
      <label>Number of Pages</label>
      <input type="text" class="form-control" name="book_pages" value="<?php echo $book['book_pages']; ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="col-12 mb-3">
      <label>Book Description</label>
      <textarea name="book_description" class="form-control"><?php echo $book['book_description']; ?></textarea>
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Update Book</button>
</form>      <form class="delete-form" action="delete.php" method="post">
        <input type="hidden" name="book_id" value="27">
        <button class="btn btn-danger" type="submit">Delete Book</button>
      </form>
    </section>
  </main>
</body>

</html>