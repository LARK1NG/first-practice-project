<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init(
  $config["host"],
  $config["duser"],
  $config["dpw"],
  $config["dname"]
);  $result=mysqli_query($conn, "SELECT * FROM topic");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="http://localhost/style.css?after">
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
        echo '<li><a href="http://localhost/index.php?id='.$row['id'].'">'.$row['title'].'</a></li>'."\n";
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
      <form action="process.php" method="post">
        <p>
          제목: <input type="text" name="title">
        </p>
        <p>
          작성자: <input type="text" name="author">
        </p>
        <p>
          본문: <textarea name="description" id="description"></textarea>
        </p>
        <input type="hidden" role="uploadcare-uploader" />
        <input type="submit" name="name">
      </form>
    </article>
    <script>
      UPLOADCARE_PUBLIC_KEY = "118cc7b50e87da2e081b"
      UPLOADCARE_TABS = "file camera url facebook gdrive gphotos"
    </script>

    <script>
      var singleWidget = uploadcare.SingleWidget('[role=uploadcare-uploader]');
      singleWiget.onUploadComplete(function(info){
        document.getElementById('description').
        value = document.getElementById('description').
        value + '<img src="'+info.cdnUrl+'">';
      });
    </script>
  </body>
</html>
