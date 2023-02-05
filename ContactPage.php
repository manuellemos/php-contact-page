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
  private $icons = array();
  private $texts = array();

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
	error_log(__FUNCTION__.' '.$property.' '.serialize($value));
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
	$contact = '<div style="position: fixed; bottom: 300px; right: 28px;">';
	if($this->contactEmailAddress !== '')
	{
		$message = $this->getText('Contact-us-using-email');
		$contact .= '<div style="background-color: #000000; border-radius: 12px; padding: 14px 1px 16px 14px; margin: 8px; border-width: 1px; border-color: #000000; border-style: solid; width: 39px"><a target="_blank" href="mailto:'.$this->contactEmailAddress.'" title="'.HtmlSpecialChars($message).'">'.$this->getIcon('mail', $message).'</a></div>';
	}
	if($this->contactFacebookMessenger !== '')
	{
		$message = $this->getText('Contact-us-using-Messenger');
		$contact .= '<div style="background-color: #ffffff; border-radius: 12px; padding: 8px; margin: 8px; border-width: 1px; border-color: #000000; border-style: solid; width: 39px"><a target="_blank" href="https://m.me/'.$this->contactFacebookMessenger.'" title="'.htmlspecialchars($message).'">'.$this->getIcon('FacebookMessenger', $message).'</a></div>';
	}
	if($this->contactWhatsApp !== '')
	{
		$message = LocaleText('Contact-us-using-WhatsApp');
		$contact .= '<div style="background-color: #25d366; border-radius: 12px; padding: 8px 4px 8px 9px; margin: 8px; border-width: 1px; border-color: #000000; border-style: solid; width: 39px"><a target="_blank" href="https://api.whatsapp.com/send?phone='.$this->contactWhatsApp.'&text='.UrlEncode(str_replace('{site}', $this->system_name, LocaleText('Hello-I-visited-your-site-and-I-need-your-help'))).'" title="'.$message.'">'.$this->getIcon('WhatsApp', $message).'</a></div>';
	}
	$contact .= '</div>';
	return $contact;
  }
};
