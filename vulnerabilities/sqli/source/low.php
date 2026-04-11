<?php

if( isset( $_REQUEST[ 'Submit' ] ) ) {
    // Get input
    $id = $_REQUEST[ 'id' ];

    // Validación: solo permitir valores numéricos
    if(!is_numeric($id)) {
        echo "<pre>ERROR: Entrada no válida.</pre>";
        exit;
    }

    // Prepared Statement para evitar SQL Injection
    $stmt = $GLOBALS["___mysqli_ston"]->prepare(
        "SELECT first_name, last_name FROM users WHERE user_id = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Get results
    while( $row = mysqli_fetch_assoc( $result ) ) {
        $first = $row["first_name"];
        $last  = $row["last_name"];
	//       echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";
	echo "<pre>ID: " . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . 
   	  "<br />First name: " . htmlspecialchars($first, ENT_QUOTES, 'UTF-8') . 
     	"<br />Surname: " . htmlspecialchars($last, ENT_QUOTES, 'UTF-8') . "</pre>";
    }

    $stmt->close();
    mysqli_close($GLOBALS["___mysqli_ston"]);
}
?>
