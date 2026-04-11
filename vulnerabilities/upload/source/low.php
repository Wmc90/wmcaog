<?php

if( isset( $_POST[ 'Upload' ] ) ) {
    // Where are we going to be writing to?
    $target_path  = DVWA_WEB_PAGE_TO_ROOT . "hackable/uploads/";
    
    // Obtener información del archivo
    $uploaded_name = $_FILES[ 'uploaded' ][ 'name' ];
    $uploaded_tmp  = $_FILES[ 'uploaded' ][ 'tmp_name' ];
    $uploaded_ext  = strtolower( pathinfo( $uploaded_name, PATHINFO_EXTENSION ) );
    
    // Validar extensión con lista blanca
    $allowed_extensions = array( "jpg", "jpeg", "png", "gif" );
    
    // Validar tipo MIME real con finfo (no confiar en $_FILES['type'])
    $finfo    = finfo_open( FILEINFO_MIME_TYPE );
    $mime     = finfo_file( $finfo, $uploaded_tmp );
    finfo_close( $finfo );
    $allowed_mimes = array( "image/jpeg", "image/png", "image/gif" );
    
    if( !in_array( $uploaded_ext, $allowed_extensions ) || 
        !in_array( $mime, $allowed_mimes ) ) {
        echo '<pre>Solo se permiten imágenes (jpg, jpeg, png, gif).</pre>';
    } else {
        // Renombrar archivo para evitar ejecución directa
        $new_name   = uniqid() . '.' . $uploaded_ext;
        $target_path .= $new_name;
        
        if( !move_uploaded_file( $uploaded_tmp, $target_path ) ) {
            echo '<pre>Your image was not uploaded.</pre>';
        } else {
		//    echo "<pre>{$new_name} succesfully uploaded!</pre>";
	echo "<pre>" . htmlspecialchars($new_name, ENT_QUOTES, 'UTF-8') . " succesfully uploaded!</pre>";
        }
    }
}

?>
