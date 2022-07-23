<?php

require_once 'config/Database.php';

class FeedbackModel extends Database {
  private $name;
  private $email;
  private $body;

  public function __construct($name = "", $email = "", $body = "") {
    $this->name = $name;
    $this->email = $email;
    $this->body = $body;
  }

  /**
   * create feedback
   */
  public function createFeedback() {
    $sql = "INSERT INTO feedback(name, email, body, date) VALUES(:name, :email, :body, NOW())";

    $stmt = $this->getDb()->prepare($sql);

    $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
    $stmt->bindValue(':body', $this->body, PDO::PARAM_STR);

    $result = $stmt->execute();
    $stmt->closeCursor();

    return $result;
  }

  /**
   * read feedbacks
   */
  public function getFeedbacks() {
    $sql = "SELECT * FROM feedback";

    $stmt = $this->getDb()->query($sql);

    $feedbacks = $stmt->fetchAll();
    $stmt->closeCursor();
    
    return $feedbacks;
  }

  /**
   * getters
   */
  public function getName() { return $this->name; }
  public function getEmail() { return $this->email; }
  public function getBody() { return $this->body; }
  
  /**
   * setters
   */
  public function setName($name) { $this->name = $name; }
  public function setEmail($email) { $this->email = $email; }
  public function setBody($body) { $this->body = $body; }
}
