<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Bücher-Antiquariat</title>
  <link rel="stylesheet" href="Style/css.css">
  <h1>Bücher-Antiquariat</h1>
  <h2>Bücher:</h2>


</head>
<body>
  <?php
  include('db_connector.php');

  $sqltodo = "SELECT * FROM buecher";
  $resulttodo = $mysqli->query($sqltodo);

  if ($resulttodo->num_rows > 0) {
    while($row = $resulttodo->fetch_assoc()) {
      echo "<p>";
      echo "ID: ". $row["id"]. "<br>".
        "Katalog: ". $row["katalog"]. "<br>".
        "Nummer: ". $row["nummer"]. "<br>".
        "Kurztitel: ". $row["kurztitle"]. "<br>".
        "Kategorie: ". $row["kategorie"]. "<br>".
        "Verkauft: ". $row["verkauft"]. "<br>".
        "Käufer: ". $row["kaufer"]. "<br>".
        "Autor: ". $row["autor"]. "<br>".
        "Titel: ". $row["title"]. "<br>".
        "Sprache: ". $row["sprache"]. "<br>".
        "Foto: ". $row["foto"]. "<br>".
        "Verfasser: ". $row["verfasser"]. "<br>".
        "Zustand: ". $row["zustand"];
      echo "</p>";
    }
  } else {
    echo "<br>";
    echo "Keine To-Dos vorhanden";
  }
  ?>
</br>
</body>
</html>
