<?php

function base64_to_img($base64_string) {
    $img_ext = explode('/',explode(';',$base64_string)[0])[1];
    $img_name = "/public/upload/images/".uniqid('img_').".$img_ext";
    // open the output file for writing
    $ifp = fopen( __DIR__."/../..$img_name", 'w' ) or die("Unable to open file!");

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp );

    return $img_name;
}
