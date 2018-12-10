<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['update'])) {
    $QUESTION = new BlogQuestion($_POST['id']);

    $QUESTION->subject = $_POST['subject'];
    $QUESTION->question = $_POST['question'];
    $QUESTION->location = $_POST['location'];


    $VALID = new Validator();
    $VALID->check($QUESTION, [
        'subject' => ['required' => TRUE],
        'question' => ['required' => TRUE],
        'location' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $QUESTION->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}