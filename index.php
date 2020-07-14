<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="Wrapper">
    <h1>Technikteam Anmeldeformular für eine Veranstaltung</h1>

    <form action="ValidateForm.php" method="get">
        <table>
        
            <tr>
               <td> <span style="color:#9D2032;">*</span> Name der Veranstaltung: </td> 
               <td> <input type="text" name="nameOfEvent" Required></td>
            </tr>
            <tr>
                <td> <span style="color:#9D2032;">*</span> Ansprechpartner: </td>
                <td> <input type="text" name="ansprechpartner" Required> </td>
            </tr>
            <tr>
                <td><span style="color:#9D2032;">*</span> Datum: </td> 
                <td> <input type="date" name="eventDate"Required> </td>
            </tr>
            <tr>
                <td><span style="color:#9D2032;">*</span> Ort: </td>
                <td> <input type="text" name="location"Required> </td>
            </tr>
            <tr>
                <td><span style="color:#9D2032;">*</span> Beginn: </td>
                <td> <input type="time" name="start"></td>
            </tr>
            <tr>    
                <td><span style="color:#9D2032;">*</span> Ende:</td>
                <td><input type="time" name="end"></td>
            </tr>
            <tr>
                <td> <label>&nbsp;Anzahl der benötigten Mikrofone: </td>
                <td> <input type="Number" name="neededMics"> </label> </td>
            </tr>
            
        </table> 
        <hr>
        Extras: <br>
<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "rama-portal";

$conn = new mysqli($servername,$username, $password,$dbname );
$sqlCommand = "SELECT * FROM `technikteamgeraete`";
$sqlCommandResult = $conn->query($sqlCommand);

if($sqlCommandResult->num_rows > 0){
    $rowid = 0;
    while($row = $sqlCommandResult->fetch_assoc()) 
    {
        echo"<label> <input type='checkbox' name='".$rowid ."' value='1'> <span class='label-text'>".$row["GeraeteName"]."</span>  </label> <br>";
        $rowid ++;
    }

}else{
    echo "keine zusätzlichen Geräte sind verfügbar";
}

?>        
    
        
        <hr>
        Zusätzliche Informationen <br>
          <textarea name="additionalInfos" rows="5" cols="40"></textarea> </label> <br>
        <br>
        <input type="submit" value="Veranstaltung anmelden">
    </form>
</div>
</body>
</html>