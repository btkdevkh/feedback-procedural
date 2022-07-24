<?php

require_once 'controllers/FeedbackController.php';
$feedbackController = new FeedbackController();

// simple route
if(isset($_GET['url'])) { 
  $url = explode('=', filter_var($_GET['url'], FILTER_SANITIZE_URL));

  // echo '<pre>';
  // var_dump($url);
  // echo '</pre>';

  switch ($url[0]) {
    case 'create':
      $feedbackController->createAndUpdateFeedback();
      break;
    case 'feedbacks':
      $feedbackController->getFeedbacks();
      break;
    case 'update':
      $param = $url[1] ?? null;
      $feedbackController->createAndUpdateFeedback($param);
      break;
    case 'delete':
      $param = $url[1] ?? null;
      $feedbackController->deleteFeedback($param);
      break;
    case 'about':
      $feedbackController->about();
      break;
    default:
      $feedbackController->index();
      break;
  } 
} else {
  $feedbackController->index();
}
