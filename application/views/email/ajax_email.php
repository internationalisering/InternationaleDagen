
<?php
echo "<label>Name: </label><input id=\"templateNaam\" class=\"form-control\" value=\"" . $template->naam . "\" name=\"naam\" type=\"text\" required>";
echo"<label>Subject: </label><input id=\"templateOnderwerp\" class=\"form-control\" value=\"" . $template->onderwerp . "\" name=\"onderwerp\" type=\"text\" required>";
echo"<label>Content: </label><textarea id=\"templateInhoud\" class=\"form-control\" rows=\"15\" name=\"inhoud\" required >" . $template->inhoud . "</textarea>";
?>