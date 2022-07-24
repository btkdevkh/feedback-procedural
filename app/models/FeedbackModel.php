<?php

class FeedbackModel extends Database {
  /**
   * create feedback
   */
  public function createFeedback($name, $email, $body) {
    $sql = "INSERT INTO feedback(name, email, body, date) VALUES(:name, :email, :body, NOW())";
    $stmt = $this->getDb()->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':body', $body, PDO::PARAM_STR);
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
   * read feedback
   */
  public function getFeedback($id) {
    $sql = "SELECT * FROM feedback WHERE id = :id";
    $stmt = $this->getDb()->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    $feedback = $stmt->fetch();
    $stmt->closeCursor();
    if($result) return $feedback;
  }

  /**
   * update feedback
   */
  public function updateFeedback($name, $email, $body, $id) {
    $sql = "UPDATE feedback SET name = :name, email = :email, body = :body, date = NOW() WHERE id = :id";
    $stmt = $this->getDb()->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':body', $body, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    $stmt->closeCursor();
    return $result;
  }

  /**
   * delete feedback
   */
  public function deleteFeedback($id) {
    $sql = "DELETE FROM feedback WHERE id = :id";
    $stmt = $this->getDb()->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $result = $stmt->execute();
    $stmt->closeCursor();
    return $result;
  }
}
