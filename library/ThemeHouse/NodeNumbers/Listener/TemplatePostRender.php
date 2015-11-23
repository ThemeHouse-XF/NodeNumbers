<?php

class ThemeHouse_NodeNumbers_Listener_TemplatePostRender extends ThemeHouse_Listener_TemplatePostRender
{
	public function run() {
		switch ($this->_templateName)
		{
			case 'node_list':
				$this->_nodeList();
				break;
		}
		return parent::run();
	}

	public static function templatePostRender($templateName, &$content, array &$containerData, XenForo_Template_Abstract $template)
	{
		$templatePostRender = new ThemeHouse_NodeNumbers_Listener_TemplatePostRender($templateName, $content, $containerData, $template);
		list($content, $containerData) = $templatePostRender->run();
	}

	protected function _nodeList()
	{
		$viewParams = $this->_fetchViewParams();
		$nodes = $viewParams['nodes'];
		foreach ($nodes as $node) {
			$pattern = '#(\.' . $node['node_id'] . '/edit">\s*<em>)#';
			$replacement = '['.$node['display_order'].'] ';
			$this->_contents = preg_replace($pattern, '$1' . $replacement , $this->_contents);
		}
	}
}