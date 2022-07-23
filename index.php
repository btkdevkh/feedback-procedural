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
      $feedbackController->index();
      break;
  } 
} else {
  $feedbackController->index();
}
