<?php

	require('ContactPage.php');

	$contact_email_address = 'mlemos@gmail.com';
	$contact_whatsapp = '5514998068719';
	$contact_facebook_messenger = '114418241923267';
	
	$contact_page = new \PhpContactPage\ContactPage;
	$contact_page->contactEmailAddress = $contact_email_address;
	$contact_page->contactFacebookMessenger = $contact_facebook_messenger;
	$contact_page->contactWhatsApp = $contact_whatsapp;
	$contact_page->cssStyle = 'position: fixed; bottom: 0px; right: 32px; z-index: 16777271;';
	$contact_page->cssClass = '';
	$contact_page->icons = array(
		'mail'=>'<img src="Email.png">',
		'FacebookMessenger'=>'<img src="FacebookMessenger.svg">',
		'WhatsApp'=>'<img src="WhatsApp.svg">'
	);
	$contact_page->texts = array(
		'Contact-us-using-email'=>'Contact us using email',
		'Contact-us-using-Messenger'=>'Contact us using Facebook Messenger',
		'Contact-us-using-WhatsApp'=>'Contact us using WhatsApp',
		'Hello-I-visited-your-site-and-I-need-your-help'=>'Hello, I visited your site and I need your help.'
	);
	if($contact_page->initialize()
	&& $contact_page->process()
	&& $contact_page->process(true))
	{
		$output = '<h2>Look at the contact button bar at the bottom right corner of this page. -&gt;</h2>'.$contact_page->output();
	}
	else
		$output = 'Error: '.HtmlSpecialChars($contact_page->error);
?>
<html>
<head>
<title>Test Contact Page Example</title>
</head>
<body>
<h1>Test Contact Page Example</h1>
<hr>
<?php

	echo $output;
	
?>
<hr />
</body>
</html>