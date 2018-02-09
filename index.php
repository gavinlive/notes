


<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <style>
            .text {
                word-wrap: break-word;
                overflow-wrap: break-word;
                width: 100%;
            }
        </style>

        <title>Notes by Gavin</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    </head>

    <?php
    $token1 = $_POST['t'];
    $token2 = $_GET['t'];
    if(isset($token1)) { $t = $token1; } elseif(isset($token2)) { $t = $token2; } else { $t = "default"; };
    ?>


    <body>
        <nav class="navbar navbar-light bg-faded rounded navbar-toggleable-md">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#containerNavbarCenter" aria-controls="containerNavbarCenter" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-md-center" id="containerNavbarCenter"><form method="post">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Current Token: <input type="text" name="t" value="<?php echo md5($t); ?>" style="border:0px;background-color: none;"  id="token" /></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><input type="submit" value=">>" style="border: 0; background-color: none; padding-top: 2px; padding-bottom: 2px;" class="btn btn-primary"  /></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Computer Sync</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown05">
                    <a class="dropdown-item" href="?t=ehalls">Gavin's eHalls action plan</a>
                    <a class="dropdown-item" href="?t=mres">Gavin's MRes action plan</a>
                    <a class="dropdown-item" href="?t=gs">Gavin's GS action plan</a>
                  </div>
                </li>
              </ul>
            </form></div>

          </nav>

          <div class="jumbotron text">
            <div class="col-sm-8 mx-auto text">
              <h1>Notes</h1>
                <?php
                $filename = $t;
                if(!file_exists($filename)) {
                    $tmp = fopen($filename, 'w') or die("<span style=\"color:red;\">Cannot create new file</span>");
                    fwrite($tmp, "Content goes here! \n \nEnjoy!");
                    echo "<span style=\"color:blue;font-weight:900;\">File didn't exist, so I create one for you!</span>";
                    fclose($tmp);
                }

                $file = fopen($filename, "rb") or die("cannot read");
                $contents = fread($file, filesize($filename));
                fclose($file);

                $contents = htmlspecialchars($contents);
                $contents = nl2br($contents);
                $contents = trim(preg_replace('/\s+/', ' ', $contents)); // remove any "newlines" i.e. remove \n


                ?>

                <!--- EDITOR--->
                <div style="text-align: left; margin: 10 5 5 10; font-size: 20px;" class="text">
                    <span  onClick="this.contentEditable='true';"  id="thenote" name="thenote" class="text" style="display: inline-block; vertical-align: middle; line-height: normal;"><?php echo $contents; ?></span>
                </div>

                <!--<div id="previewBox">test goes here</div>--->
                <!--- END EDITOR--->

              <p>
                <a class="btn btn-primary" href="www.gavinseegoolam.co.uk" role="button" disabled>GS.co.uk &raquo;</a>
              </p>
            </div>
          </div>
        </div>

        <!---Bootstrap v4!--->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="dynamic_notes.js"></script>
    </body>
</html>
