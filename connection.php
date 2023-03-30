<?php
 $db = mysqli_connect('localhost', 'user_name', 'user_password', 'db_name') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'db_name' ) or die(mysqli_error($db));
?>
