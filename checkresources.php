<?
    /* checkresources.php
     * Carl Pillot
     *
     * Page checks for the existence of the index.txt file and audio files specified in the file. 
     */
    ini_set("auto_detect_line_endings", true);
    $indexname = "resources/index.txt";
    $errors = array();
    $successes = array();
    
    if(!$file = @fopen($indexname,"r")){
        array_push($errors,"Can't open index file: ".$indexname);
    } else {
        array_push($successes,'index.txt file exists');
        $lines = array();
        
        if ($file) {
            while (($buffer = fgets($file, 4096)) !== false) {
                array_push($lines,$buffer);
            }
            if (!feof($file)) {
                array_push($errors,"Unexpected fgets() fail. Index file may be corrupted.");
            }
        }     
        fclose($file);
        
        foreach($lines as &$line) {
            $line = explode("\t",$line);
        }
        
        // Separate headers from lines
        $headers = array_shift(&$lines);
        
        // find audio file header location
        $audio_index = array_search('audio', $headers);
        
        // check if audio file exists for each audio value
        foreach ($lines as $item) {
            $audio_path = 'resources/sounds/'.$item[$audio_index].'.mp3';
            if(!file_exists($audio_path)) {
                array_push($errors,'Audio file "'.$audio_path.'" does not exist.');
            } else {
                array_push($successes,'Audio file "'.$audio_path.'" exists.');
            }
        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
<title>Experigen Resource Checker</title>
<style type="text/css">
body {
    background:#445;
    font-size:16px;
    font-family:helvetica, verdana, sans-serif;
}
#error_display {
    width: 50%;
    margin:auto;
    margin-top:20px;
    padding: 15px 30px 30px 30px;
    border:1px solid black;
    background:#FFFFFF;
    //text-align:center;
}
#error_display h1 {
    margin: 0px 0px 20px 0px;
    font-size:1.75em;
}
#error_display h2 {
    margin: 5px;
    font-size:1.25em;
}
#error_display ul {
    list-style-type:none;
    padding:0;
}
#error_display ul#successes {
    //color:green;
}
#error_display ul#failures {
    color:red;
}
#error_display li{
    margin:0 0 0 5px;
    padding:0;
}
</style>

</head>
<body>
<div id="error_display">
<h1>Experigen Resource Checker</h1>
    
<? 
if(!$file = @fopen($indexname,"r")){
    print('<h2>Error:</h2><p>Unable to open index file '.$indexname.'</p>');
} else {

    $lines = array();
        
    if ($file) {
        while (($buffer = fgets($file, 4096)) !== false) {
            array_push($lines,$buffer);
        }
        if (!feof($file)) {
            array_push($errors,"Unexpected fgets() fail. Index file may be corrupted.");
        }
    }     
    fclose($file);
    
    foreach($lines as &$line) {
        $line = explode("\t",$line);
    }
    
    // Separate headers from lines
    $headers = array_shift(&$lines);
        
    if ($audio_categories == '' && $image_categories == '') {
        
    }
}
    //print($audio_categories);
?>

    <h2>Successful Tests:</h2>
    <div style="height:200px;overflow:auto;border:1px dotted black;">
<?  
    if(count($successes) === 0) {
        print('<p style="color:red">No tests passed successfully.</p>');
    } else {
        print('<ul id="successes">');
        foreach($successes as $success) {
            print('<li>'.$success.'</li>');
        }    
        print('</ul>');
    }  
?>
    </div>
    <hr />
    <div>
<? 
    if(count($errors) === 0) {
        print('<p style="color:green">No Errors Found!</p>');
    } else {
        print('<h2>Errors:</h2><ul id="failures">');
        foreach($errors as $error) {
            print('<li>'.$error.'</li>');
        }    
        print('</ul>');
    }
?>
    </div>
</div>
</body>
</html>