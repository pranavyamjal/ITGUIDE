<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Create Blog</h2>
        <form action="process_blog.php" method="post">
            <div class="form-group">
                <label for="blog_image_url">Image URL:</label>
                <input type="text" class="form-control" id="blog_image_url" name="blog_image_url" placeholder="Enter Image URL">
            </div>

            <div class="form-group">
                <label for="blog_description">Title:</label>
                <input type="text" class="form-control" id="blog_description" name="blog_title" placeholder="Enter Title">
            </div>
            
            <div class="form-group">
                <label for="blog_description">Description:</label>
                <input type="text" class="form-control" id="blog_description" name="blog_description" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label for="blog_details">Details:</label>
                <textarea class="form-control" id="blog_details" name="blog_details" rows="5" placeholder="Enter Details"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
</body>
</html>