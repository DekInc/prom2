<?php
session_start();
$_SESSION['var1'] = 'abc';
echo $_SESSION['var1'] . '<br>';
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
 session_unset(); 

echo $_SESSION['var1'] . '<br>';
// destroy the session 
 session_destroy();
echo $_SESSION['var1'] . '<br>';

echo "All session variables are now removed, and the session is destroyed." 
?>

</body>
</html>