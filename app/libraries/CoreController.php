<?php

class CoreController {
  protected $currentController;
  protected $currentMethod;
  protected $params = [];

  public function __construct() {
    if(isset($_GET['url'])) { 
      $url = explode('=', filter_var($_GET['url'], FILTER_SANITIZE_URL));

      // echo '<pre>';
      // var_dump($url);
      // echo '</pre>';
        
      if(file_exists(APPROOT . '/' . 'controllers/' . ucwords($url[0]) . '.php')) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      } else {
        header('Location:' . URL);
      }

      require_once APPROOT . '/' . 'controllers/' . $this->currentController . '.php';
      $this->currentController = new $this->currentController;

      if(isset($url[1])) {
        if(method_exists($this->currentController, $url[1])) {
          $this->currentMethod = $url[1];
          unset($url[1]);
        } else {
          header('Location:' . URL);
        }
      } else {
        header('Location:' . URL);
      }

      $this->params = $url ? array_values($url) : [];
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    } else {
      $this->render('feedback/create', [
        'title' => 'Home',
        'nameErr' => '',
        'emailErr' => '',
        'bodyErr' => '',
      ]); 
    }
  }

  /**
   * load model
   */
  protected function model($model) {
    require_once APPROOT . '/' . 'models/' . $model . '.php';
    return new $model();
  }

  /**
   * load view
   */
  protected function render(string $path, array $data = []) {
    ob_start();
    extract($data);
    require_once APPROOT . '/' . "views/$path.html.php";
    $content = ob_get_clean(); 
    require_once APPROOT . '/' . 'views/template.html.php';
  } 
}
