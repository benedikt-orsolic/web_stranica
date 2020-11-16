<?php





/* NULL for no user, anything else if found something */
function userExists( $userName, $dbConn ) {
    

    $sql = 'SELECT * FROM users WHERE username = ?;';
    $stmt = mysqli_stmt_init( $dbConn );

    if( !mysqli_stmt_prepare($stmt, $sql) ) {
        //Prep fail
        //TODO
        echo(' stmt prep fail ');
    }

    mysqli_stmt_bind_param($stmt, 's', $userName);
    mysqli_stmt_execute( $stmt );

    $result = mysqli_stmt_get_result( $stmt );
    $row = mysqli_fetch_assoc( $result );

    mysqli_stmt_close( $stmt );
    
    return $row;
}


function insertUser($userName, $password, $email, $dbConn) {

    $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init( $dbConn );

    if( !mysqli_stmt_prepare( $stmt, $sql )) {
        echo('prep fail');
        die();
    }

    $password = password_hash( $password, PASSWORD_DEFAULT );

    mysqli_stmt_bind_param( $stmt, 'sss', $email, $userName, $password);
    mysqli_stmt_execute( $stmt );
}
