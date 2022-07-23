<?php

require_once 'controllers/FeedbackController.php';
$feedbackController = new FeedbackController();

// simple route
if(isset($_GET['feedback'])) { 
  switch ($_GET['feedback']) {
    case 'create':
      $feedbackController->createFeedback();
      break;
    case 'feedbacks':
      $feedbackController->getFeedbacks();
      break;
    case 'about':
      $feedbackController->about();
      break;
    default:
      break;
  } 
} else {
  require_once 'views/feedback/create.html.php';
}
