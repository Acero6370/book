<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Bücher-Antiquariat</title>
    <link rel="stylesheet" href="Style/css.css">
</head>
    <body>
        <a href="index.php"><h1>Bücher-Antiquariat</h1></a>
        <form action="index.php" method="POST">
            <input type="text" name="suche" placeholder="suchen">
        </form>
        <h2>Bücher:</h2>
        <?php
            include('db_connector.php');
            $buecherProSeite = 10;

            $versatz = 0;
            if(isset($_GET["seite"]) && isset($_GET["seite"])) {
                $seite = intval($_GET["seite"]);
                $versatz = $seite * $buecherProSeite;
            }

            if(isset($_POST["suche"]) && !empty(trim($_POST["suche"]))) {

                $suche = "%". htmlspecialchars(trim($_POST["suche"])) ."%";
                $stmt = $mysqli->prepare('select * from buecher where kurztitle like ? limit ?, ?');
                $stmt->bind_param("sii", $suche, $versatz, $buecherProSeite);
                $stmt->execute();
                $resultBuecher = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }
            else {

                $stmt = $mysqli->prepare('select * from buecher limit ?, ?');
                $stmt->bind_param("ii", $versatz, $buecherProSeite);
                $stmt->execute();
                $resultBuecher = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }

            if (sizeof($resultBuecher) > 0) {
                foreach($resultBuecher as $row) {
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
            }
            else {
                echo "<br>";
                echo "Keine Bücher vorhanden";
            }
        ?>
        <a href="index.php?seite=<?php if(!isset($seite) || $seite < 2) { echo "0"; } else echo $seite - 1; ?>"><button>Vorherige Seite</button></a>
        <a href="index.php?seite=<?php echo ($seite ?? 0) + 1 ?>"><button>Nächste Seite</button></a>
        </br>
    </body>
</html>
