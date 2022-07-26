<?php include 'inc/header.php' ?>

<?php
  $db = connectDB();

  $sql = "SELECT * FROM feedback";
  $result = $db->query($sql);
  $feedbacks = $result->fetchAll();
?>
   
  <h2>Feedback</h2>

  <?php if(empty($feedbacks)) : ?>
    <p class="lead mt-3">There is no feedback</p>
  <?php endif; ?>

  <?php foreach($feedbacks as $item) : ?>
    <div class="card my-3 w-75">
      <div class="card-body text-center">
        <?= $item['body']; ?>

        <div class="text-secondary mt-2">
          By <?= $item['name']; ?> on <?= $item['date']; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

<?php include 'inc/footer.php' ?>