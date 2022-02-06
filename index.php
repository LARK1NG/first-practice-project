<?php
  require("config/config.php");
  require("lib/db.php");
  $conn = db_init(
    $config["host"],
    $config["duser"],
    $config["dpw"],
    $config["dname"]
  );
  $result=mysqli_query($conn, "SELECT * FROM topic");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
    initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
    <link rel="stylesheet" href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css">
  </head>
  <body id="target">
    <header>
      <img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png"
      alt="생활코딩">
      <h1><a href="http://localhost/index.php">JavaScript</a></h1>
    </header>
    <nav>
      <ol>
      <?php
      while($row=mysqli_fetch_assoc($result)){
        echo '<li><a href="http://localhost/index.php?id='.
        $row['id'].'">'.htmlspecialchars($row['title']).'</a></li>'."\n";
      }
       ?>
      </ol>
    </nav>
    <div id="control">
      <input
        type="button"
        value="white"
        onclick="document.getElementById('target').className='white'"
      />
      <input
        type="button"
        value="black"
        onclick="document.getElementById('target').className='black'"
      />
      <a href="http://localhost/write.php">쓰기</a>
    </div>
    <article>
      <?php
      if(empty($_GET['id']) === false) {
        $sql = 'SELECT * FROM topic WHERE id='.$_GET['id'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
        echo '<p>'.htmlspecialchars($row['author']).'</p>';
        echo strip_tags(
          $row['description'], '<a>,<h1>,<h2>,<h3>,<h4>,<h5>,<ul>,<ol>,<li>'
        );
      }
       ?>
    </article>
    <script
    src= "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
</html>
