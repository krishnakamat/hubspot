  <?php
	$url = 'http://spreadsheets.google.com/feeds/list/1XRSgXkJsuLgXsRPNB4Xrz6-aoMp4CqU4ycuKb2-S9WI/od6/public/values?alt=json';
	$file= file_get_contents($url);

	$json = json_decode($file);
	$rows = $json->{'feed'}->{'entry'};

	$listingContent = "<table><th>Full Name</th><th>Image</th><th>Bio</th><th>Locations</th>";

	foreach($rows as $row) {
	  $fullname = $row->{'gsx$fullname'}->{'$t'};
	  $image = $row->{'gsx$image'}->{'$t'};
	  $bio = $row->{'gsx$bio'}->{'$t'};
	  $locations = $row->{'gsx$locations'}->{'$t'};

	  $listingContent = $listingContent . "<tr><td>" . $fullname . "</td><td>" . $image . "</td><td>" . $bio . "</td><td>" . $locations . "</td></tr>";
	}
	$listingContent = $listingContent . "</table>";
 
	include('ganon.php');

	$html = file_get_dom('http://valitesystems-2.hs-sites.com/trsom-sample-page/');

	foreach($html('.custom-json-data span') as $element) {
	   $element->setInnerText($listingContent);
	}

	foreach($html('html head title') as $element) {
	   $element->setInnerText("Changed Title");
	}

	 echo $html;


  ?>