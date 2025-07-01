<?php
/*
 * ContactPage.php
 *
 * @(#) $Id: $
 *
 */
 
namespace PhpContactPage;

class ContactPage
{
  public $error = '';

  private $contactEmailAddress = '';
  private $contactEmailText = '';
  private $contactFacebookMessenger = '';
  private $contactWhatsApp = '';
  private $cssStyle = 'position: fixed; bottom: 20px; right: 32px;';
  private $cssClass = '';
  private $icons = array();
  private $texts = array();
  private $positions = array(
	'WhatsApp',
	'FacebookMessenger',
	'Email'
  );

  private function getIcon($icon, $alt)
  {
	if(!IsSet($this->icons[$icon])) {
      trigger_error('requested an invalid icon: '.$icon);
      return $alt;
	}
    return(str_replace('{alt}', $alt, $this->icons[$icon]));
  }
  
  private function getText($text)
  {
	if(!IsSet($this->texts[$text])) {
      trigger_error('requested an invalid text: '.$text);
      return $text;
	}
    return($this->texts[$text]);
  }
  
  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }

    return $this;
  }

  public function initialize()
  {
    return true;
  }

  public function process()
  {
     return true;
  }

  public function finalize()
  {
    return true;
  }

  public function output()
  {
	$contact = '<div'.($this->cssStyle !== '' ? ' style="'.$this->cssStyle.'"' : '').($this->cssClass !== '' ? ' class="'.$this->cssClass.'"' : '').'>';
	foreach($this->positions as $position)
	{
		switch($position)
		{
			case 'Email':
				if($this->contactEmailAddress !== '')
				{
					$message = $this->getText('Contact-us-using-email');
					$contact .= '<div style="background-color: #000000; border-radius: 8px; padding: 5px 4px 5px 5px; margin: 4px; border-width: 1px; border-color: #000000; border-style: solid; width: 37px"><a target="_blank" href="mailto:'.$this->contactEmailAddress.'" title="'.HtmlSpecialChars($message).'">'.$this->getIcon('mail', $message).'</a></div>';
				}
				break;
			case 'FacebookMessenger':
				if($this->contactFacebookMessenger !== '')
				{
					$message = $this->getText('Contact-us-using-Messenger');
					$contact .= '<div style="background-color: #ffffff; border-radius: 8px; padding: 4px 4px 4px 5px; margin: 4px; border-width: 1px; border-color: #000000; border-style: solid; width: 37px"><a target="_blank" href="https://m.me/'.$this->contactFacebookMessenger.'" title="'.htmlspecialchars($message).'">'.$this->getIcon('FacebookMessenger', $message).'</a></div>';
				}
				break;
			case 'WhatsApp':
				if($this->contactWhatsApp !== '')
				{
					$message = $this->getText('Contact-us-using-WhatsApp');
					$contact .= '<div style="background-color: #25d366; border-radius: 8px; padding: 7px 3px 4px 6px; margin: 4px; border-width: 1px; border-color: #000000; border-style: solid; width: 37px"><a target="_blank" href="https://api.whatsapp.com/send?phone='.$this->contactWhatsApp.'&text='.UrlEncode(str_replace('{site}', $this->system_name, $this->getText('Hello-I-visited-your-site-and-I-need-your-help'))).'" title="'.$message.'">'.$this->getIcon('WhatsApp', $message).'</a></div>';
				}
				break;
		}
	}
	$contact .= '</div>';
	return $contact;
  }
};
