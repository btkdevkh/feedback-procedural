<?php ob_start(); ?>

<h2>About</h2>

<p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore impedit totam porro iure reiciendis autem possimus sapiente, optio, exercitationem ipsum assumenda mollitia, recusandae expedita culpa ratione voluptatem esse quos quam?</p>

<?php 
$title = 'About';
$content = ob_get_clean(); 
require_once 'views/template.html.php';
?>