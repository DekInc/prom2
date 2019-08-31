<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
session_unset(); 
session_destroy();
?>
<script>
	location.href = 'config.php';
</script>
</body>
</html>