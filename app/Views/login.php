<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <form id="signup">
        <input type="text" placeholder="Enter Your Name" name="name">
        <input type="text" placeholder="Enter Your Email" name="email">
        <input type="password" placeholder="Enter Your password"name="password">
        <input type="password" placeholder="Confirm password">
        <button type="submit" value="submit">Submit</button>
    </form>
    <div id="response"></div> <!-- For displaying response message -->
</body>

</html>

<script>
    $(document).ready(function() {
    $("#signup").submit(function(e) {
        e.preventDefault(); // Prevent form from submitting normally

        let formData = $(this).serialize();

        $.ajax({
            url: 'usersignup',  // Make sure this route is correct
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response); // Debugging purpose
                if (response.status === 'success') {
                    $("#response").html("<p style='color:green'>" + response.message + "</p>");
                } else if (response.status === 'error') {
                    let errors = response.errors;
                    let errorMessages = "";
                    $.each(errors, function(key, value) {
                        errorMessages += "<p style='color:red'>" + value + "</p>";
                    });
                    $("#response").html(errorMessages);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: " + error);
                $("#response").html("<p style='color:red'>An error occurred. Please try again.</p>");
            }
        });
    });
});

</script>