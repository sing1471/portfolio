<?php 
require_once "db.php";

if(isset($_GET['id'])){
    $sql='SELECT * FROM books WHERE book_id=:book_id';
  $stmt=$db->prepare($sql);
  $stmt->bindValue(':book_id', $_GET['id']);
  $stmt->execute();
  $book=$stmt->fetch();

  $sql='SELECT * FROM quotes WHERE book_id=:book_id';
  $stmt=$db->prepare($sql);
  $stmt->bindValue(':book_id', $_GET['id']);
  $stmt->execute();
  $quotes=$stmt->fetchAll();

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
  <title><?php echo $book['book_title']; ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main>
      <?php include 'header.php'; ?> 
  <h1 class="page-title"><?php echo $book['book_title']; ?></h1>
    <section class="book-details">
    <?php if($book['book_image']) {?>
              <img class="book-image" src="book-covers/<?php echo $book['book_image'];?>" alt="Dr. Seuss's ABC">
              <?php }?>
            <div class="book-details-content">
        <a href="edit.php?id=<?php echo $book['book_id']; ?>" class="edit-button"><i class="fas fa-edit fa-2x"></i></a>
        <h2 class="book-details-title">About the Book</h2>
        <p><?php echo $book['book_description']; ?></p>
        <div class="book-details-stats">
          <span>Published: <?php echo $book['book_year'] ;?></span>
          <span>Pages:<?php echo $book['book_pages']; ?> </span>
        </div>
                  <h3 class="book-details-title">Book Quotes</h3>
          <div class="book-details-quotes">
              <?php foreach($quotes as $quote): ?>
                          <blockquote class="book-details-quote"><?php echo $quote['quote'] ;?></blockquote>
                          <?php endforeach;?>
                      </div>
              </div>
    </section>
  </main>
</body>

</html>