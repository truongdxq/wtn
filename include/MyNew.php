<?php
class MyNew
{
	private $id;
	private $name_new;
	private $link_image;
	private $url_video;
	private $url_page;
	private $description;
	private $created_at;
	private $type;

	public function __construct($name_new, $link_image, $url_video, $url_page, $description)
	{
		$newname_new = str_replace("n&#244;ng", "nông", $name_new);
		$this->name_new = $newname_new;
		$this->link_image = $link_image;
		$this->url_video = $url_video;
		$this->url_page = $url_page;
		$this->description = $description;
	}
	public function set_id($id)
	{
		$this->id = $id;
	}
	public function get_id()
	{
		return $this->id;
	}
	public function set_name_new($name_new)
	{
		$this->name_new = $name_new;
	}
	public function get_name_new()
	{
		return $this->name_new;
	}
	public function set_link_image($link_image)
	{
		$this->link_image = $link_image;
	}
	public function get_link_image()
	{
		return $this->link_image;
	}
	public function set_url_video($url_video)
	{
		$this->url_video = $url_video;
	}
	public function get_url_video()
	{
		return $this->url_video;
	}
	public function set_url_page($url_page)
	{
		$this->url_page = $url_page;
	}
	public function get_url_page()
	{
		return $this->url_page;
	}
	public function set_description($description)
	{
		$this->description = $description;
	}
	public function get_description()
	{
		return $this->description;
	}
	public function set_created_at($created_at)
	{
		$this->created_at = $created_at;
	}
	public function get_created_at()
	{
		return $this->created_at;
	}
	public function set_type($type)
	{
		$this->type = $type;
	}
	public function get_type()
	{
		return $this->type;
	}
	public function to_string()
	{
		return $this->name_new." - ".$this->link_image." - ".$this->url_video." - ".$this->description." - ".$this->type;
	}
}
?>