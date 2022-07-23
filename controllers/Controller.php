<?php

class Controller {
  protected function render(string $path, array $data = []) {
    ob_start();
    extract($data);
    require_once "views/$path.html.php";
    $content = ob_get_clean(); 
    require_once 'views/template.html.php';
  }
}
