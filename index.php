<?php
include_once('classes/Video.php');


$video = new Video;

//returns id from URL
$id = $video->get_id();

//table I'll be using on this page
$table = "English";

//gets the data for the current video to be shown
$data = $video->fetch_data($id, $table);

//gets random videos from a table
$videos = $video->get_most_watched($table);

//gets related videos depending on current video_category
$related = $video->get_related($id, $table);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>StirFY</title>
<meta name="stirfy" content="stirfy.com">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="http://stirfy.com/assets/css/nav-style.css">
<link rel="stylesheet" href="http://stirfy.com/assets/css/normalize.css">
<link rel="stylesheet" href="http://stirfy.com/assets/css/custom-styles.css">
<link rel="stylesheet" href="http://stirfy.com/assets/css/grid.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!-- Favicon -->

<link rel="icon" href="http://stirfy.com/assets/icons/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="http://stirfy.com/assets/icons/favicon.ico" type="image/x-icon"/>

<!-- FB related stuff -->

<meta property="og:title" content="<?php echo $data['video_title']?>"/>
<meta property="og:type" content="video"/>
<meta property="og:url" content="http://stirfy.com/index.php?id=<?php echo $id?>"/>
<meta property="og:image" content="https://i1.ytimg.com/vi/<?php echo $data['video_id']?>/mqdefault.jpg"/>
<meta property="og:site_name" content="stirfy.com"/>
<meta property="fb:admins" content="100000956149607"/>
<meta property="og:description"
content="<?php echo $data['video_title']?>"/>


<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<link rel="stylesheet" href="css/ie.css">
<![endif]-->
<script src="http://stirfy.com/assets/js/responsive-nav.js"></script>
</head>
<body>
<!--Javascript SDK-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<!-- ANALYTICS -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66102104-1', 'auto');
  ga('send', 'pageview');

</script>
<header>
    <div>
        <a href="http://stirfy.com" class="logo" data-scroll><span class="inset-text">stir</span><span class="logo-last">FY</span></a>

        <nav class="nav-collapse">
            <ul>
                <li><a href="index.php">Home</a></li>
                <!--<li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>-->
            </ul>
        </nav>
    </div>
</header>

<!-------------------->
<div class="banner">
   <h1> <?php echo $data['video_title']?></h1>
</div>

<!-------------------->

<!-- SOCIAL -->

<div class="center">
    <div class="fb-like" data-href="http://stirfy.com/index.php?id=<?php echo $id?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
</div>

<!-- --------------- -->

<div class="grid video-container">

            <!-- control=0 can be added -->
    <iframe id="video" class="ifr" src="https://www.youtube.com/embed/<?php echo $data['video_id'];?>?modestbranding=1&loop=1&showinfo=0" frameborder="0" allowfullscreen></iframe>

</div>

<!-------------------->

<div class="center">
     <div class="fb-page" data-href="https://www.facebook.com/stirfy" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
</div>


<!-- ------------------------------------------------------------- -->


<div class="division">
    <h2> Related Videos</h2>
</div>


<div class="grid grid-pad">
    <div class="col-1-4">
        <div class="module">

            <a href="http://stirfy.com/index.php?id=<?php echo $related[0]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $related[0]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $related[0]['video_title']?></h3>

        </div>
    </div>

    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $related[1]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $related[1]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $related[1]['video_title']?></h3>
        </div>
    </div>


    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $related[2]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $related[2]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $related[2]['video_title']?></h3>
        </div>
    </div>

    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $related[3]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $related[3]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $related[3]['video_title']?></h3>
        </div>
    </div>


</div>
<!-- -------------------------------------------------------------- -->

<div class="division">
    <h2> Most Watched Videos</h2>
</div>


<div class="grid grid-pad">
    <div class="col-1-4">
        <div class="module">

            <a href="http://stirfy.com/index.php?id=<?php echo $videos[0]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[0]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[0]['video_title']?></h3>

        </div>
    </div>

    <!---->
    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[1]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[1]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[1]['video_title']?></h3>
        </div>
    </div>

    <!---->
    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[2]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[2]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[2]['video_title']?></h3>
        </div>
    </div>

    <!---->
    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[3]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[3]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[3]['video_title']?></h3>
        </div>
    </div>

    <!---->
</div>

<!------------------------------------------------------------------------>


<div class="grid grid-pad">
    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[4]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[4]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[4]['video_title']?></h3>
        </div>
    </div>



    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[5]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[5]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[5]['video_title']?></h3>
        </div>
    </div>


    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[6]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[6]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[6]['video_title']?></h3>
        </div>
    </div>


    <div class="col-1-4">
        <div class="module">
            <a href="http://stirfy.com/index.php?id=<?php echo $videos[7]['id']?>"><img id="video" src="http://i1.ytimg.com/vi/<?php echo $videos[7]['video_id']?>/mqdefault.jpg"></img></a>
            <h3><?php echo $videos[7]['video_title']?></h3>
        </div>
    </div>


</div>

<!-- -------------------------------------------------------- -->

<footer class="grid grid-pad">
  <div class="fb-comments" data-href="http://stirfy.com/index.php?id=<?php echo $id;?>" data-width="1200" data-numposts="5">
</div>

</footer>
    <script src="http://stirfy.com/assets/js/fastclick.js"></script>
    <script src="http://stirfy.com/assets/js/scroll.js"></script>
    <script src="http://stirfy.com/assets/js/fixed-responsive-nav.js"></script>
  </body>
</html>
