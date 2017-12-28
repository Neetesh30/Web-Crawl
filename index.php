<?php

/*

Web Crawler to display images of other website with url link to re-direct the User to the Original Site.

This page uses PHP, - Backend , Bootstrap for Front-End Skills to display and Images .

This page is also small - devices friendly for easy view and scrolling.

*/

?>
<html>
<head>
<title>Web Crawl</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
  body{
	  
	  background: radial-gradient(farthest-side at 60% , #c3b9b9, #c3c3bb, #e2cdcd);
  }
  </style>
  
</head>

<body >




<!-- Container -->

<div class="container">


 <div class="row"> <!-- Section -->
  
  <?php
 //function to to parse xml to php
function getFeed($feed_url) {
		
	//Reads entire file into a string	
    $content = file_get_contents($feed_url);
	
	//Represents an element in an XML document.
    $x = new SimpleXmlElement($content);

	//Inititalize counter to restrict data to max of 25 limit
	$i = 1;
	
    foreach($x->channel->item as $entry) {
			
		//identify child xml tag for image and use URL Attribute to get image path	
		$namespaces = $entry->getNamespaces(true);   
		$media_url =    trim((string)$entry->children($namespaces['media'])->content->attributes()->url);
		
	?>	
	<!-- Divide Image and Text Display in three columns of a row -->
	<div class="col-md-4 col-xs-12 pull-right">  
			<img src="<?php echo $media_url;?>" class="img-rounded   " alt="Image Not Found "onerror="this.src = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTL07f7Q0HLCf_4RzECzXG8RFqrbNFZx0IkToT3nHO9mDy_IMtBQ'" width="304" height="236"> 
			
				<!-- identify child xml tag for image title -->
				<h3> <?php echo"<a target='_blank' href='$entry->link' title='$entry->title'>" . $entry->title . "</a>"	;?></h3>
	</div>
		<?php
		// End The ForEach Loop if it reaches count of 25.
		 if ($i++ == 24) break;
    }
    
}


//Getting URL to extract data from website
getFeed('http://www.firstpost.com/rss/india.xml');

?>
	
</div>   <!-- Section Ends -->

</body>

</html>
