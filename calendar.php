<!Doctype html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="style.css">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rama-portal";

$conn = new mysqli($servername,$username, $password,$dbname );


$sqlCommand = "SELECT * FROM `events` ORDER BY `Datum` ASC;";

$sqlCommandResult = $conn->query($sqlCommand);
// In der IF-Clause wird die Tabelle erstelt und falls keine Daten vorhanden sind wird ein Text angezeigt
if($sqlCommandResult->num_rows > 0)
{
    echo "<div class=Wrapper>";
    $rowID = 0;
    echo "<table class=Calendar>";
    echo "<tr>";
    echo "<td> Name der Veranstaltung </td>";
    echo "<td>Ansprechpartner</td>";
    echo "<td>Ort</td>";
    echo "<td>Datum</td>";
    echo "<td>Beginn</td>";
    echo "<td>Ende</td>";
    
    echo "</tr>";

    

    
    while($row = $sqlCommandResult->fetch_assoc()) 
    {
        echo "<tr>";
        echo "<td>", $row["Name"], "</td>";
        echo "<td>", $row["Ansprechpartner"], "</td>";
        echo "<td>", $row["Ort"],"</td>";
        echo "<td>", $row["Datum"],"</td>";
        echo "<td>", $row["Start"]," Uhr","</td>";
        echo "<td>", $row["Ende"], " Uhr" ,"</td>";
        
        echo "</tr>";
        $rowID ++;
    }

    echo "</table>";

    

}else{
    echo "<div class=Wrapper>";
    echo "<p> Momentan sind keine Veranstaltungen geplant oder angemeldet </p>";
    echo "</div>";
}
?>


<br>
<div class="menuWrapper">
    <!--Der Link zum Portal ist nur ein Platzhalter und kann noch ersetzt werden, sodass man direkt wieder auf die Startseite kommt und sich nicht wieder anmelden muss-->
    <a href="">Zurück zum Portal</a>
    <a href="index.php">Ein Event anmelden</a>
</div>

</body>
</html>