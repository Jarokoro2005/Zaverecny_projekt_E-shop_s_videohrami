<?php require("parts/header.php"); ?>

<link rel="stylesheet" href="assets/css/thankyou.css">

<div class="container thankyou-wrapper" style="text-align:center; padding: 4rem 1rem;">
    <div style="max-width: 600px; margin: 0 auto;">

        <div class="checkmark"></div>

        <h1 class="thankyou-title">
            Thank You!
        </h1>

        <p class="thankyou-text">
            Your message has been successfully sent.  
            Our support team will get back to you within 24 hours on business days.
        </p>

        <a href="index.php" class="btn btn-solid" style="padding: 0.8rem 2rem; font-size: 1rem;">
            ← Back to Home
        </a>

        <p class="redirect-info">
            You will be redirected automatically in <strong>5 seconds</strong>.
        </p>
    </div>
</div>

<script>
setTimeout(() => {
    window.location.href = "index.php";
}, 5000);
</script>

<?php require("parts/footer.php"); ?>
