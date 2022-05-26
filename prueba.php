<?php

   $contrasena = hash('sha512','1234');
   $contrasena = hash('sha256',$contrasena);
   $contrasena = hash('sha256',$contrasena);
   $contrasena = hash('sha512',$contrasena);
   echo $contrasena;
?>