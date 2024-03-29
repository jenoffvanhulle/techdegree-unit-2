<?php
/*
 * PHP Techdegree Project 2: Build a Quiz App in PHP
 *
 * These comments are to help you get started.
 * You may split the file and move the comments around as needed.
 *
 * You will find examples of formating in the index.php script.
 * Make sure you update the index file to use this PHP script, and persist the users answers.
 *
 * For the questions, you may use:
 *  1. PHP array of questions
 *  2. json formated questions
 *  3. auto generate questions
 *
 */

// Include questions
session_start();
include "generate_questions.php";

// Keep track of which questions have been asked
$total = 10;
$page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
if (empty($page)) {
    session_destroy();
    $page = 1;
}

// Show which question they are on
// Show random question
// Shuffle answer buttons
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

function quiz() {
    global $page;
    global $randomQuestions;

    $answerButtons = [
    $randomQuestions[$page-1]["correctAnswer"],
    $randomQuestions[$page-1]["firstIncorrectAnswer"],
    $randomQuestions[$page-1]["secondIncorrectAnswer"],
    ];
    shuffle($answerButtons);

    if ($page > 1) {
        checkAnswer();
    }

    echo "<p class='breadcrumbs'>Question " . $page . " of 10</p>";
    echo "<p class='quiz'>What is " . $randomQuestions[$page-1]["leftAdder"] . " + " . $randomQuestions[$page-1]["rightAdder"] . "?</p>";
    echo "<form action='index.php?p=" . ($page+1) . "' method='post'>";
    echo "<input type='hidden' name='id' value='0' />";
    echo "<input type='submit' class='btn' name='answer' value='" . $answerButtons[0] . "'>";
    echo "<input type='submit' class='btn' name='answer' value='" . $answerButtons[1] . "'>";
    echo "<input type='submit' class='btn' name='answer' value='" . $answerButtons[2] . "'>";
    echo "<input type='hidden' name='correct' value='" . $randomQuestions[$page-1]["correctAnswer"] . "'>";
    echo "</form>";
}


// Toast correct and incorrect answers
// Keep track of answers
// If all questions have been asked, give option to show score
// else give option to move to next question
if ($page > $total) {
    checkAnswer();
    header('location: score.php');
    exit;
}

function checkAnswer() {
    if (isset($_POST['answer'])) {
        $_SESSION['answer'] = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_NUMBER_INT);
    }
    if (isset($_POST['correct'])) {
        $_SESSION['correct'] = filter_input(INPUT_POST, 'correct', FILTER_SANITIZE_NUMBER_INT);
    }
    if ($_SESSION['answer'] == $_SESSION['correct']) {
        echo "<p class='correct'>Well done! That's the correct answer.</p>";
        ++$_SESSION['score'];
    } else {
        echo "<p class='incorrect'>Bummer! The correct answer was " . $_SESSION['correct'] . ".</p>";
    }
    return $_SESSION['score'];
}

// Show score
function score() {
	echo "<p class='quiz'>Your score is " . $_SESSION["score"] . " out of 10.</p>";
}

// Retake the quiz
function retake() {
    echo "<form action='index.php' method='post'>";
    echo "<input type='submit' class='btn' name='retake' value='Take the quiz again'>";
    echo "</form>";
}
