<?php

class CoreController {
  protected $currentController;
  protected $currentMethod;
  protected $params = [];

  public function __construct() {
    // simple route
    if(isset($_GET['url'])) { 
      $url = explode('=', filter_var($_GET['url'], FILTER_SANITIZE_URL));

      // echo '<pre>';
      // var_dump($url);
      // echo '</pre>';
      
      if(file_exists('controllers/' . ucwords($url[0]) . '.php')) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }

      require_once 'controllers/' . $this->currentController . '.php';

      $this->currentController = new $this->currentController;

      if(isset($url[1])) {
        if(method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          unset($url[1]);
        }
      }

      $this->params = $url ? array_values($url) : [];

      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
      
    } else {
      $this->render('feedback/create', ['title' => 'Home']);
    }
  }

  protected function render(string $path, array $data = []) {
    ob_start();
    extract($data);
    require_once "views/$path.html.php";
    $content = ob_get_clean(); 
    require_once 'views/template.html.php';
  } 
}
