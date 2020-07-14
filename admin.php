<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<?php
echo "<div class=Wrapper>";
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "rama-portal";
 
echo"<div class='menuWrapper'>
    <!--Der Link zum Portal ist nur ein Platzhalter und kann noch ersetzt werden, sodass man direkt wieder auf die Startseite kommt und sich nicht wieder anmelden muss-->
    <a href=''>Zurück zum Portal</a>
    <a href='index.php'>Ein Event anmelden</a>
    <a href='calendar.php'>Kalender</a>
    </div>";
echo "<hr>";
echo "<div id='AdmincontrollPanel'>";
echo "<form action='' method='get'>
    Gerätename:
    <input type='text' name='GeraeteName'> &nbsp; <input type='submit' value='Bestätigen'> <br>
    <input type='radio' name='action' value='0' Required> l&ouml;schen <br>
    <input type='radio' name='action' value='1'> hinzufügen <br>
    
    </form>";
    echo "<form action='admin.php' method='get'>
    Eventname:
    <input type='text' name='EventToDelete'> &nbsp; <input type='submit' value='Event löschen'> <br>
    </form>";

echo "</div>"  ;  
echo "<hr>";
echo "<div id='AdmincontrollPanel'>";
$conn = new mysqli($servername,$username, $password,$dbname );





if(isset($_GET["GeraeteName"])){
    switch($_GET["action"]){
        case 0:
            $sqlCommand = "DELETE FROM `technikteamgeraete` WHERE GeraeteName='".$_GET["GeraeteName"]."'";

        break;
        case 1:
            $sqlCommand = "INSERT INTO `technikteamgeraete`(`GeraeteName`) VALUES ('".$_GET["GeraeteName"]."')";

        break;
    }
    if(!$conn->query($sqlCommand) == true){
        echo "Error: " . $sqlCommand . "<br>" . $conn->error; 
    }
}

if(isset($_GET["EventToDelete"])){
    $sqlCommand = "DELETE FROM events WHERE Name='". $_GET["EventToDelete"]."'";
     if(!$conn->query($sqlCommand) == true){
         echo "Error: " . $sqlCommand . "<br>" . $conn->error; 
     }
     $sqlCommand = "DELETE FROM detailtabelle WHERE Name='". $_GET["EventToDelete"]."'"; 
     if(!$conn->query($sqlCommand) == true){
        echo "Error: " . $sqlCommand . "<br>" . $conn->error; 
    }

}

$sqlCommand = "SELECT * FROM `technikteamgeraete`;";
$sqlCommandResult = $conn->query($sqlCommand);

if($sqlCommandResult->num_rows > 0){
    
    echo "<Table class=Calendar> <tr> <td> Name </td> </tr>";
    
    while($row = $sqlCommandResult->fetch_assoc()) 
    {
        echo "<tr> <td>". $row["GeraeteName"] . "</td> </tr>";
    }
    
    
}

$sqlCommand = "SELECT * FROM `detailtabelle` ORDER BY `Datum` ASC;";
$sqlCommandResult = $conn->query($sqlCommand);
if($sqlCommandResult->num_rows > 0){
    $rowID = 0;
    echo "<Table class=Calendar> <tr> <td> Name </td> <td> Ansprechpartner </td> <td> Ort </td> <td> Datum</td> <td> Beginn </td> <td> Ende </td> </tr>";
    while($row = $sqlCommandResult->fetch_assoc()) 
    {
        echo "<tr>";
        echo "<td>", $row["Name"], "</td>";
        echo "<td>", $row["Ansprechpartner"], "</td>";
        echo "<td>", $row["Ort"],"</td>";
        echo "<td>", $row["Datum"],"</td>";
        echo "<td>", $row["Beginn"]," Uhr","</td>";
        echo "<td>", $row["Ende"], " Uhr" ,"</td>";
        echo "<td> <button onclick=document.getElementById('details", $rowID ,"').classList.toggle('enabled');> Details </button> ";
        echo "<div id='details", $rowID, "' class=extrainfo>";
        echo "<ul>";
        echo "<li> <strong> Ben&ouml;tigte Mikrofone:</strong> ", $row["benötigteMikrofone"], "</li>";
        echo "<li> <strong> Zus&auml;tzliche Ausrüstung:</strong> <br> ", $row["zusätzlicheGeräte"], "</li>";
        echo "<li> <strong> Zus&auml;tzliche Informationen:</strong> <br> ", $row["zusätzlicheInformationen"] , "</li>";
        echo "</tr>";
        $rowID ++;
    }
    echo "</table>";
}else{
    echo "<Table> <tr><td>Momentan sind keine Veranstaltungen geplant oder angemeldet</td></tr></table>";  
}





?>
</div>



</body>
</html>