<?php
session_start();
require("php/savesound.php");
?>
<html>
<head>
<title>Sound OFF</title>
<meta name="description" content="Sound OFF"/>
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<link href='img/so.png' type='image/png' rel='icon'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="css/AssignFonts.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:100,200,300,400,500,600,1000|Bad+Script|Ubuntu|Lato:100,200,300,400|Tauri|Exo+2:100,200,300,400|Alegreya+Sans:400,300|Roboto+Condensed' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/mp3recorder.js"></script>
<script type="text/javascript" src="js/pagerecorder.js"></script>

</head>
<body>
<div id="page">
<?php
    if(isset($_REQUEST['saved'])){echo "<div id='saved'>Audio comment posted!</div><script type='text/javascript'>setInterval(function(){window.location='./';},5000);</script>";}
    if(isset($_REQUEST['error'])){echo "<div id='error'>Audio comment failed. Please try again later.</div><script type='text/javascript'>setInterval(function(){window.location='./';},5000);</script>";}
?>
    <div id="post">
        <div id="title">Apple boss Tim Cook 'to donate millions' to charity</div>
        <div id="information">
            <a id="timestamp">Posted 10 hours ago</a>
            <a id="author">By Dave Johnson</a>
        </div>
        <div id="content">
            <img src="img/sample1.png"/>
            <p>The head of the world's most profitable company is worth over &pound;537m.  Mr Cook told Fortune Magazine that he would leave his wealth to philanthropic causes but not before paying for his 10-year-old nephew's college education.  He joins a growing number of the world's super-rich who are giving away their wealth, including Facebook founder Mark Zuckerberg.  Five years ago, billionaire investor Warren Buffett and Microsoft founder Bill Gates launched the campaign The Giving Pledge.  It aims to convince billionaires to give at least half of their fortunes to charity. Mr Zuckerberg and over 100 others have so far signed up to the "moral commitment". Mr Cook's base salary went up by 43% in February 2014, rising to &pound;6.2m a year.  According to Fortune Magazine, he holds &pound;81m worth of Apple shares and a further &pound;447m of restricted stocks.  A private US university education costs an estimated &pound;20,000 on average.</p>
        </div>
        <div id="share">
            <a id="facebook">Share on Facebook</a>
            <a id="twitter">Share on Twitter</a>
            <a id="google">Share on Google+</a>
        </div>
    </div>

    <div id="sidebar">
        <div class="section">
            <div class="title">Sound Off!</div>
            <a class="recorder"><img class="start" src="img/record.png"/><img class="stop" src="img/stoprec.png"/></a>

            <div id="submitrecording"><form action="php/savesound.php?save" method="post">
            <textarea id="audiodescription" name="audiodescription" maxlength="45" placeholder="Add a comment (under 45 characters)" required></textarea>
            <input type="text" name="audioclip" id="audioclip"/>
            <input type="submit" id="uploadRec" value="Upload"/><br>
            <a id="deleteRec" onclick="confirm('Are you sure you want to start again?')">Start again</a>
            </form></div>
            <?php
            $gcq=mysqli_query(cons(),"SELECT * FROM audioclips ORDER BY acid DESC");
            while($getclip=mysqli_fetch_array($gcq)){echo "<div class='clip'><div class='profpic'><img src='".$getclip['acpic']."'/></div><div class='name'><b>".$getclip['acname']."</b>: ".$getclip['acdescription']."</div><div class='playback'><audio controls><source src='".$getclip['aclip']."' type='audio/wav'></audio></div></div>";}
            ?>
        </div>
    </div>
</div>
</body>
</html>