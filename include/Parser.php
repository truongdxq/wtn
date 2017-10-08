<?php
set_time_limit(3000);
include("../libs/simplehtmldom_1_5/simple_html_dom.php");
include_once("MyNew.php");
require_once dirname(__FILE__) . '/Config.php';

class Parser{
	function contain($strp, $strc)
	{
		if (strpos($strp, $strc) !== false) {
			return true;
		}
		else
		{
			return false;
		}
	}
	function sub_string_from_to($p, $c1, $c2)
	{
		$index1 = strpos($p, $c1);
		$index2 = strpos($p, $c2);
		$result = substr($p, $index1, $index2-$index1);
		return $result;
	}
	function sub_string_from_toend($p, $c)
	{
		$index = strpos($p, $c);
		$result = substr($p, $index);
		return $result;
	}


	function get_content_from_page($page)
	{
		$opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
		$context = stream_context_create($opts);
		$html = file_get_html($page, false, $context);

	// $html = file_get_html($page);
	//get url_video
		$linkvd = "";
		foreach ($html->find('div[class=share_item]') as $element) {
			$input = $element->children(1);
			if($input != null)
			{
				$linkvd = $input->getAttribute("value");	
				break;	
			}
		}
		$urlvideoshort = $this->sub_string_from_to($linkvd, "vtv/", "&_videoId");
		$urlvideo  = "https://hls.vcmedia.vn/";
		$urlvideo .= $urlvideoshort;

    //get description
		$description = '';
		$element = $html->find('p[class=sapo]', 0);
		if($element != null)
		{
			$description = $element->innertext;	
		}

		$result = array();
		$result['urlvideo'] = $urlvideo;
		$result['description'] = $description;
		return $result;
	}


	function get_new_data()
	{
		$result = array();

		$optst = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" ."User-Agent: not for you\r\n"));
		$contextt = stream_context_create($optst);
		$html = file_get_html(LINK_HOMEPAGE, false, $contextt);
	// $html = file_get_html(LINK_HOMEPAGE);
        //var_dump($html);
		if($html != null)
		{
			$count = 0;
			foreach($html->find('a') as $element)
			{
				$title = $element->title;
				$img = $element->find('img', 0);
				if($count >= DEFAULT_COUNT_NEW) break;
				if($this->contain($title, "Bản tin thời tiết")  && ($img != null))
				{
					$page = "http://vtv.vn".$element->href;
					$contentpage = $this->get_content_from_page($page);
			//fix link_image to get small image
					$linkimageshort = $this->sub_string_from_toend($img->src, "vtv/");
					$linkimagenew = "http://video-thumbs.vcmedia.vn/zoom/140_83/";
					$linkimagenew .= $linkimageshort;
			//end fix
					$newtp = new MyNew($title, $linkimagenew, $contentpage['urlvideo'], $page, $contentpage['description']);
					array_push($result, $newtp);
					$count++;
				}
			}
		}
		return $result;
	}
}
$testparser = new Parser();
$result = $testparser->get_new_data();
?>