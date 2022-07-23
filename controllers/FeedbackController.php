<?php

require_once 'models/FeedbackModel.php';

class FeedbackController {
  public function createFeedback() {
    $name = $email = $body = '';
    $nameErr = $emailErr = $bodyErr = '';

    if(isset($_POST['submit'])) {
      if(empty($_POST['name'])) {
        $nameErr = 'Name is required';
      }

      if(empty($_POST['email'])) {
        $emailErr = 'Email is required';
      }

      if(empty($_POST['body'])) {
        $bodyErr = 'Feedback is required';
      }

      if(!$nameErr || !$emailErr || !$bodyErr) {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }

      if(!$nameErr && !$emailErr && !$bodyErr) {
        $feedback = new FeedbackModel($name, $email, $body);
        $result = $feedback->createFeedback();
        if($result) header('Location:' . URL . '?feedback=feedbacks');
      }
    }

    require_once 'views/feedback/create.html.php';
  }

  public function getFeedbacks() {
    $feedback = new FeedbackModel();
    $feedbacks = $feedback->getFeedbacks();
    require_once 'views/feedback/feedback.html.php';
  }

  public function about() {
    require_once 'views/about.html.php';
  }
}
