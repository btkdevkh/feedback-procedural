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

    <a href="<?= URL . '?url=delete=' . htmlspecialchars($item['id']) ?>" class="delete">X</a>
    <a href="<?= URL . '?url=update=' . htmlspecialchars($item['id']) ?>" class="update">.../</a>
  </div>
<?php endforeach; ?>
