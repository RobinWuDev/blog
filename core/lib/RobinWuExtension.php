<?php
include_once (EXTRAL_PATH."/markdown/Markdown.php");

class RobinWuExtension extends Twig_Extension
{
	public function getFilters()
	{
		return array(
				new Twig_SimpleFilter('markdown', array($this, 'markdownFilter')),
		);
	}

	public function markdownFilter($str)
	{
		$markdown = new Michelf\Markdown();
		return  $markdown->transform($str);
	}

	public function getName()
	{
		return 'robinWu_extension';
	}
}
?>