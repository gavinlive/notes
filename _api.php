<?php

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    list($contents,$filename, $webinterface) = getcontentsfromput();
    if($filename=="index.php" || $filename == "_api.php") { die(); }
    echo putcontents($contents, $filename, $webinterface);
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $filename = $_GET['t'] or die("Did not specify token!");
    if($filename=="index.php" || $filename == "_api.php") { die(); }
    if(!file_exists($filename)) {
        $tmp = fopen($filename, 'w') or die("<span style=\"color:red;\">Cannot create new file</span>");
        fwrite($tmp, "Content goes here! \n \nEnjoy!");
        //echo "<span style=\"color:blue;font-weight:900;\">File didn't exist, so I create one for you!</span>";
        fclose($tmp);
    }
    $webapi = $_GET['webapi'];
    $contents = getcontents($filename, $webapi);
    $data = array();
    $data["contents"] = $contents;
    header('Content-Type: application/json');
    echo json_encode($data);
}






function getcontentsfromput() {
    $putfp = fopen('php://input', 'r');
    $putdata = '';
    while($data = fread($putfp, 1024)) {
        $putdata .= $data; }
    fclose($putfp);
    $data = json_decode($putdata, true);

    $filename=str_replace('/', '', $data['t']);
    $contents = $data['contents'];

    $webinterface = true;
    if(isset($data['apidirect'])) {$webinterface = false;}
    return array($contents, $filename, $webinterface);
}

function putcontents($contents, $filename, $webapi) {
    if($webapi===true) {
        $contents = htmlspecialchars_decode(strip_tags(br2newline($contents)));
    }
    $opening = fopen($filename, 'w');
    $writing=fwrite($opening, $contents);
    $closing=fclose($opening);
    if($opening && $writing && $closing) {
        return(1); // success
    } else { return(0); } // failure
}


function getcontents($filename, $webapi) {
    if(!file_exists($filename)) {
        $tmp = fopen($filename, 'w') or die("<span style=\"color:red;\">Cannot create new file</span>");
        fwrite($tmp, "Content goes here! \n \nEnjoy!");
        fclose($tmp);
    }
    $file = fopen($filename, "rb") or die("cannot read");
    $contents = fread($file, filesize($filename));
    fclose($file);

    if(isset($webapi)) {
        $contents = htmlspecialchars($contents);
        $contents = nl2br($contents);
        $contents = trim(preg_replace('/\s+/', ' ', $contents)); // remove any "newlines" i.e. remove \n
    }
    return $contents;
}


function br2newline( $input ) {
     $out = str_replace( "<br>", "\n", $input );
     $out = str_replace( "<br/>", "\n", $out );
     $out = str_replace( "<br />", "\n", $out );
     $out = str_replace( "<BR>", "\n", $out );
     $out = str_replace( "<BR/>", "\n", $out );
     $out = str_replace( "<BR />", "\n", $out );
     $out = str_replace( "&nbsp;", " ", $out );
     return $out;
}


?>
