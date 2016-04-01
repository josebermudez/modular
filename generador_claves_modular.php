-- inicio archivo: generador-clave.php --
<?php // uso: http://cosa.com/generador-clave.php?clave=minuevaclave
  echo "Clave encriptada es: [".md5($_GET['clave'])."]";
?>
-- fin archivo: generador-clave.php --
