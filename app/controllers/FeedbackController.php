<?php

require_once APPROOT . '/' . 'models/FeedbackModel.php';

class FeedbackController extends CoreController {
  private $feedbackModel;

  public function __construct() {
    $this->feedbackModel = new FeedbackModel();
  }

  public function createAndUpdateFeedback($id = null) {
    if($id) $feedback = $this->feedbackModel->getFeedback($id);

    $name = $id ? $feedback['name'] : '';
    $email = $id ? $feedback['email'] : '';
    $body = $id ? $feedback['body'] : '';
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
        if($id === null) {
          $resultCreated = $this->feedbackModel->createFeedback($name, $email, $body);
          if($resultCreated) header('Location:' . URL . '?url=feedbackController=getFeedbacks');
        } else {
          $resultUpdated = $this->feedbackModel->updateFeedback($name, $email, $body, $id);
          if($resultUpdated) header('Location:' . URL . '?url=feedbackController=getFeedbacks');
        }
      }
    }

    $this->render('feedback/create', [
      'title' => isset($id) ? 'Update' : 'Create',
      'name' => $name,
      'email' => $email,
      'body' => $body,
      'nameErr' => $nameErr,
      'emailErr' => $emailErr,
      'bodyErr' => $bodyErr,
      'id' => $id
    ]);
  }

  public function getFeedbacks() {
    $feedbacks = $this->feedbackModel->getFeedbacks();
    $this->render('feedback/feedback', [
      'title' => 'Feedback',
      'feedbacks' => $feedbacks
    ]);
  }

  public function deleteFeedback($id) {
    $result = $this->feedbackModel->deleteFeedback($id);
    if($result) header('Location:' . URL . '?url=feedbackController=getFeedbacks');
  }

  public function about() {
    $this->render('pages/about', ['title' => 'About']);
  }
}
