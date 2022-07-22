<?php include 'inc/header.php' ?>

<?php
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
      $db = connectDB();

      $sql = "INSERT INTO feedback(name, email, body, date) VALUES(?, ?, ?, NOW())";
      $stmt = $db->prepare($sql);
      $result = $stmt->execute([$name, $email, $body]);

      if($result) header('Location: feedback.php');
    }
  }
?>

<img src="img/logo.png" class="w-25 mb-3" alt="">
<h2>Feedback</h2>
<p class="lead text-center">Leave feedback for Traversy Media</p>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-4 w-75" method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control <?= $nameErr ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="Enter your name" value="<?= $name ?? null ?>">

    <div class="invalid-feedback" role="alert">
      <?= $nameErr ?? null ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control <?= $emailErr ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Enter your email" value="<?= $email ?? null ?>">

    <div class="invalid-feedback" role="alert">
      <?= $emailErr ?? null ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <textarea class="form-control <?= $bodyErr ? 'is-invalid' : '' ?>" id="body" name="body" placeholder="Enter your feedback"><?= $body ?? null ?></textarea>

    <div class="invalid-feedback" role="alert">
      <?= $bodyErr ?? null ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
  </div>
</form>

<?php include 'inc/footer.php' ?>