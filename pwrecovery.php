<?php
$email = $_POST['email'];

if (! (isset($email))) {
    ?>
<form action="liga.php?section=getpw" method="post">
	<table id="tabregister" width="600">
		<tr>
			<td>Emailadresse: <input type="email" name="email"
				style="width: 500px"></td>
			<td><input type="submit" class="btn btn-info" value="Passwort senden"></td>
		</tr>
	</table>
</form>
<?php
} else {
    if ($email != "") {
        include ("includes/db.connect.inc.php");
        $result = mysqli_query($db, "SELECT * FROM $user_table WHERE email='" . mysqli_real_escape_string($db, $email) . "' ");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $passwort = $row['passwort'];
                $vorname = $row['vorname'];
                $nachname = $row['nachname'];
                $username = $row['username'];
            }
            $url1 = substr($_SERVER["SCRIPT_URI"], 0, (strlen(basename($_SERVER["SCRIPT_URI"])) * (- 1)));
            $url2 = $url1 . "inhalt.php";
            $mailtext = " Hallo $vorname $nachname,";
            $mailtext .= "\n \n Du erhälst diese Email, da auf der Liga Homepage $url2 soeben";
            $mailtext .= "\n Dein Passwort neu angefordert wurde.";
            $mailtext .= "\n ";
            $mailtext .= "\n - Dein Account lautet wie folgt -";
            $mailtext .= "\n ";
            $mailtext .= "\n Username: $username";
            $mailtext .= "\n Passwort: $passwort";
            $mailtext .= "\n ";
            $mailtext .= "\n ";
            $mailtext .= "\n Viel Spass weiterhin in unserer Online Liga,";
            $mailtext .= "\n Dein Liga-Team";
            $mail_sent = mail("$email", "Liga Passwort Recovery", $mailtext);
            echo "<p style=\"color: green\">Das Passwort wurde erfolgreich zu Deiner Emailadresse $email zugeschickt. Bitte kontrolliere jetzt Dein Email Postfach und auch Deinen Spam Ordner. </p>";
        } else {
            echo "<p style=\"color: red\">Die Emailadresse $email konnte in unserer Datenbank nicht gefunden werden!</p>";
        }
        mysql_close();
    } else {
        echo "<p style=\"color: red\">Die Emailadresse wurde nicht eingegeben!</p>";
    }
}

?>