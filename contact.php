<?php include "./includes/header.php"; ?>
<?php  include "includes/db.php"; ?>
<?php


if (isset($_POST['submit'])) {

    $to = "athanasiosvarsamis97@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $header = $_POST['email'];
    if (mail($to, $subject, $body, $header)) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
}
?>
<?php include "includes/navigation.php" ?>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="key" class="form-control" placeholder="Enter your Subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="" cols="30" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-submit" class="btn btn-custom btn-lg btn-block btn-primary" value="Submit">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<?php include "./includes/footer.php"; ?>