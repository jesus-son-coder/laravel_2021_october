<!DOCTYPE html>
<html lang="en">

<head>
    <title>Work with Radio Button Checked Event in jQuery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h3>Work with Radio Button Checked Event in jQuery</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">Work with Radio Button Checked Event in jQuery</div>
            <div class="panel-body">
                Select Here - <br/>
                <input type="radio" name="course" value="1"> Laravel 8 <br />
                <input type="radio" name="course" value="2"> CodeIgniter 4 <br />
                <input type="radio" name="course" value="3"> jQuery

                <h3 id="course_selected"></h3>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('input[type=radio][name=course]').change(function() {

                var selectedValue = this.value;

                if (selectedValue == 1) {
                    $("#course_selected").text("Welcome to Laravel 8 course");
                }
                else if (selectedValue == 2) {
                    $("#course_selected").text("Welcome to CodeIgniter 4 course");
                }
                else if (selectedValue == 3) {
                    $("#course_selected").text("Welcome to jQuery course");
                }
            });

        });

    </script>
</body>

</html>
