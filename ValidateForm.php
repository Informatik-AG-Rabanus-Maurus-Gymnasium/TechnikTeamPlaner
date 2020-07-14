<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<?php 
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "rama-portal";
//Save Data
$nameOfEvent = strval($_GET["nameOfEvent"]);
$ansprechpartner = strval($_GET["ansprechpartner"]);
$eventDate = strval($_GET["eventDate"]);
$location = strval($_GET["location"]);
$start = strval($_GET["start"]);
$end = strval($_GET["end"]);
$neededMics = intval($_GET["neededMics"]);

$additionalInfo = strval($_GET["additionalInfos"]);

$additionalTech = array();


// Send Data
$conn = new mysqli($servername,$username, $password,$dbname );
//Check Connection to Database
if($conn -> connect_error){
    die("Connection failed: " . $conn->connect_error);  
}

//Geraetetabelle Auswertung
$sql = "SELECT * FROM `technikteamgeraete`";
$sqlCommandResult = $conn->query($sql);
if($sqlCommandResult->num_rows > 0){
    $rowid = 0;
    while($row = $sqlCommandResult->fetch_assoc()){
        $data = $row["GeraeteName"];
         if(isset($_GET[$rowid])){
            array_push($additionalTech, $data);
         }
        $rowid ++;
    }
}
$additionalTechString = NULL;
foreach($additionalTech as $item){
    $additionalTechString = $additionalTechString . $item ." <br>";
}



//Command to set Form Values into DB
$sql = "INSERT INTO `events` (Name, Ansprechpartner, Datum, Ort, Start, Ende)
VALUES('$nameOfEvent', 
'$ansprechpartner', 
'$eventDate', 
'$location', 
'$start', 
'$end');";

//Check if Data is transmitted succesfully
if($conn->query($sql) === TRUE){
    echo "<p id='succesfullDataText' class=.centered> Daten erfolgreich in den Kalender übertragen</p>";
}else{
      echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO `detailtabelle` (Name, Ansprechpartner, Datum, Ort, Beginn, Ende, zusätzlicheGeräte, zusätzlicheInformationen, benötigteMikrofone)
VALUES('$nameOfEvent', 
'$ansprechpartner', 
'$eventDate', 
'$location', 
'$start', 
'$end',
'$additionalTechString',
'$additionalInfo',
'$neededMics');";


if($conn->query($sql)=== TRUE){

}else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<div class="menuWrapper">
    <a href="https://portal.rama-mainz.de">Zurück zum Portal</a>
    <a href="index.php">Ein weiteres Event anmelden</a>
    <a href="calendar.php"> Event-<br>
    kalender</a>

    </div>
</html>