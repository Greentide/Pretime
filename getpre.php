<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Gets Pretime</title>
		<link href="styles.css" rel="stylesheet" type="text/css" />

	</head>
	<body>

		<?php

		function getpre($name, $type) {
			$pre['regexp'] = "/<li .*? class=\"public\">(.*?)<\/li>/ms";
			$pre['url'] = "http://predb.ninjacentral.co.za/index.php?s=" . $name;
			$pre['file'] = file_get_contents($pre['url']);
			preg_match_all("/\<li .*? class=\"public\"><a href=\".*?\">message at <\/span><time datetime=\"(.*?)\">.*?<dd>(.*?) \((.*?)\) (.*?)<\/.*?><\/li>/", $pre['file'], $pre['matches']);
			foreach ($pre['matches'][4] as $key => $val) {
				if (!preg_match("/" . $name . "/", $val)) {
					unset($pre['matches'][0][$key], $pre['matches'][1][$key], $pre['matches'][2][$key], $pre['matches'][3][$key], $pre['matches'][4][$key]);
				}
			}
			sort($pre['matches'][0]);
			sort($pre['matches'][1]);
			sort($pre['matches'][2]);
			sort($pre['matches'][3]);
			sort($pre['matches'][4]);

			$ptime = $pre['matches'][$type][0];
			$rep = $pre['matches'][4][0];
			$cat = $pre['matches'][3][0];

			if (empty($ptime)) {
				echo "";
			} else {

				function cat_clean($data) {
					$originals = array("0", "3", "5", "7", "8", "9", "10");
					$replacements = array("", "", "", "", "", "", "", "", "", "");
					$data = str_ireplace($originals, $replacements, $data);
					return $data;
				}

				$myData = $cat;
				$cat_clean = cat_clean($myData);

				function replace($data) {
					$originals = array("(", ")");
					$replacements = array("", "");
					$data = str_ireplace($originals, $replacements, $data);
					return $data;

				}

				$myData = $rep;
				$cleaned = replace($myData);
			}

			function replace2($data2) {
				$originals2 = array(".", "-", "DVDRip", "XviD", "RedBlade", "TWiST", "MAGNiTUDE", "WEBRip", "FTP", "TWiST", "HDNORDiC", "BLURAY", "COMPLETE", "Fi", "LIMITED", "HDTV", "x264", "TLA", "NOSCREENS", "1080p", "FiHTV", "HTV", "C4TV", "2HD", "EVOLVE", "KILLERS", "BALLS", "720p", "PDTV", "FQM", "BWB", "_", "FoV", "INNOCENCE", "iGNiTiON", "DVDR", "2012", "ViDERE", "SPANiSH", "SCARED", "2011", "NTSC", "WTF", "SHOCKWAVE", "KYR", "SKGTV", "CRiMSON", "TARGET", "PSYCHD", "ANGELiC");
				$replacements2 = array(" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ");
				$data2 = str_ireplace($originals2, $replacements2, $data2);
				return $data2;

			}

			$myData2 = $cleaned;
			$cleaned2 = replace2($myData2);

			if (empty($cleaned2)) {
				echo "<table width='680' border='0'>
	<tr>
    <th width='120' class='whead' scope='row'>Notice</th>
    <td class='out_name'>Please make sure you have entered the correct name</td>
	
  </tr>
  </table>";

			} else {

				$htmlout = "<table width='680' border='0'>
  <tr>
    <th width='120' class='thead' scope='row'>Category</th>
    <td class='out_name'>$cat_clean</td>
	
  </tr>
  <tr>
    <th width='120' class='thead' scope='row'>Scene Name</th>
    <td class='out_name'>$cleaned</td>
  </tr>
  <tr>
    <th width='120' class='thead' scope='row'>Proper Name</th>
    <td class='out_name'>$cleaned2</td>
  </tr>
  <tr>
  <th width='120' class='thead' scope='row'>Release Time</th>
    <td class='out_name'>$ptime</td>
  </tr>
  <tr>
    <th scope='row'>&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  
</table>";
				print $htmlout;
			}

			/*include("../classes/imdb.php");
			 {
			 $imdb = new Imdb();
			 $movieArray = $imdb->getMovieInfo($cleaned2);
			 echo '<table width="680" border="0" align="left" cellpadding="0" cellspacing="0" class="out_name">';
			 foreach ($movieArray as $key=>$value){
			 $value = is_array($value)?implode("<br />", $value):$value;
			 echo '<tr>';
			 echo '<th width="120" valign="top" class="thead"><font size="0.5">' . strtoupper($key) . '</font></th><div class="out_name"><td>' . $value . '</td></div>';
			 echo '</tr>';
			 }
			 echo '</table>';
			 }

			 */
		}

		if (empty($_POST["fname"])) {
			echo "<table width='680' border='0'>
	<tr>
    <th width='120' class='whead' scope='row'>Error</th>
    <td class='out_name'>You did not enter a name</td>
	
  </tr>
  </table>";
		} else {
			//This is where the input name or var go's
			print getpre($_POST["fname"], 1);
		}
		?>
