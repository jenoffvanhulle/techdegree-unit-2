<?php
include 'inc/quiz.php';
include 'inc/header.php'; ?>
    <div class="container">
      <div id="quiz-box">
        <?php score() . "<br>" . retake(); ?>
      </div>
    </div>
 <?php include 'inc/footer.php'; ?>