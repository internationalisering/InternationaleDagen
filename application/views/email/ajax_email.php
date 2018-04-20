
<?php
/**
 * @file ajax_email.php
 * @author Quinten van Casteren
 * 
 * Pagina met de ajax-code om een template op te halen.
 * 
 * @see Email
 */

echo "<label>Name: </label><input id=\"templateNaam\" class=\"form-control\" value=\"" . $template->naam . "\" name=\"naam\" type=\"text\" required>";
echo "<label>Subject: </label><input id=\"templateOnderwerp\" class=\"form-control\" value=\"" . $template->onderwerp . "\" name=\"onderwerp\" type=\"text\" required>";
echo "<label>Content: </label><textarea id=\"templateInhoud\" class=\"form-control\" rows=\"15\" name=\"inhoud\" required >" . $template->inhoud . "</textarea>";
?>