<?php

require_once "db.php";

if(isset($_GET['search'])){
  $sql='SELECT * FROM books WHERE book_title LIKE :search';
  $stmt=$db->prepare($sql);
  $stmt->bindValue(':search', "%{$_GET['search']}%");
  $stmt->execute();
  $books=$stmt->fetchAll();
}

else{
  $sql='SELECT * FROM books';
$result=$db->query($sql);
$books=$result->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seussology</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
  <?php include 'header.php'; ?> 
  <h1 class="page-title">Books</h1>
    <form class="form">
      <div class="form-group flex-grow">
        <input type="search" class="form-input" placeholder="Search books titles..." name="search" value="">
        <button type="submit" class="form-submit"><i class="fas fa-search fa-2x"></i></button>
      </div>
    </form>
    <section>
      <div class="books">
        <?php foreach($books as $book): ?>
          <?php if($book['book_image']){ ?>
                              <a href="book.php?id=<?php echo $book['book_id'] ?>" class="book">
                              <img class="book-image" src="book-covers/<?php echo $book['book_image'];?>" alt="<?php echo $book['book_title'];?>">
                          </a> <?php } else {?>
                            <a href="book.php?id=<?php echo $book['book_id'] ?>" class="book">
                            <div class="book-image-placeholder bg-red"><?php echo $book['book_title'];?> </div><?php }?>
                          <?php endforeach; ?>
    </section>
  </main>


</body></html> 