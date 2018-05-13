<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dhiraagu SMS Gateway PHP SDK Demo</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
</head>

<body>

    <div style="min-height: 100vh" class="d-flex justify-content-center align-items-center">
        <div class="container">
            <form method="POST">
                <h1 class="mb-5">Dhiraagu Bulk SMS Demo</h1>

                <?php if (! empty($app->alerts)) : ?>
                <div id="alerts">
                    <?php foreach($app->alerts as $alert) : ?>
                    <div class="alert alert-<?php echo $alert['type'] ?? 'info'; ?>" role="alert">
                        <?php echo $alert['text'] ?? ''; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $app->username; ?>" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" value="<?php echo $app->password; ?>" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="url" class="form-control" name="url" value="<?php echo $app->url; ?>" placeholder="Enter url">
                </div>
                <div class="form-group">
                    <label for="number">Mobile Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+960</span>
                        </div>
                        <input type="text" class="form-control" name="number" value="<?php echo $app->number; ?>" placeholder="Enter number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" placeholder="Enter message"><?php echo $app->message; ?></textarea>
                </div>
                <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>
</body>
</html>