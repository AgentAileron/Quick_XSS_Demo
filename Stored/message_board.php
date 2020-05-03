<?php
    // Variables for later use
    $file_name = "msgs.txt";
    $msg_begin = "~~~~MSG BEGIN~~~~\n";
    $msg_end = "~~~~MSG END~~~~\n";

    // If there is a submission, write it to the file on the server.
    if(($_REQUEST["subject"] != "") && ($_REQUEST["comments"] != ""))
    {
        $file = fopen($file_name, "a"); // Open/create file to write in append mode
        fwrite($file, "\n");
        fwrite($file, $msg_begin);
        if (isset($_COOKIE["user"]))
            fwrite($file, "User: " . $_COOKIE["user"] . "\n");
        fwrite($file, "Date: " . date("r") . "\n");
        // If the post contains a quotation symbol (e.g. "), it is by default replaced
        // with a backslash and quote (\") when written to the file. The purpose of
        // stripslashes below is to remove the backslash when it is written to the
        // file. Note that this enables the Javascript to be inserted into the
        // subject or comment text unaltered, causing a potential XSS hole.
        fwrite($file, "Subject: " . stripslashes($_REQUEST["subject"]) . "\n");
        fwrite($file, "Comment:\n" . stripslashes($_REQUEST["comments"]) . "\n");
        fwrite($file, $msg_end);
        fwrite($file, "\n\n");
        fclose($file);
    }
?> 