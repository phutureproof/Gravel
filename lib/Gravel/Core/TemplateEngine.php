<?php

namespace Gravel\Core;

abstract class TemplateEngine
{
	public static $data = [
		'views'    => [],
		'compiled' => ''
	];

	public static $yieldRegex = "!@yield\('(?<yields>.*)'\)!";
	public static $extendsRegex = "!@extends\('(?<extends>.*)'\)!";
	public static $sectionsRegex = "!@section\('(?<sections>.*)'\)!";
	private static $_privateTemplateName = 'gravel_private_template';

	public static function parseTemplate($file, $data = [])
	{
		extract($data);

		ob_start();
		require($file);
		$output = ob_get_clean();
		$file = substr($file, strlen(APP_DIR . '/views/'), -4);

		if (!preg_match("!@(extends|section|endsection|yield)!", $output)) {
			self::$data['compiled'] = $output;
			return true;
		} else {
			$toAdd = [];

			// match yields
			if (preg_match_all(self::$yieldRegex, $output, $matches)) {
				foreach ($matches['yields'] as $yield) {
					$toAdd['yields'][$yield] = true;
					$toAdd['sections'][self::$_privateTemplateName] = $output;
					$toAdd['sections'][$yield] = '';
				}
			}

			// match and remove extends
			if (preg_match(self::$extendsRegex, $output, $matches)) {
				$toAdd['extends'][$matches['extends']] = true;
				$output = preg_replace("!@extends\('(.*)'\)!", '', $output);
				foreach (array_keys($toAdd['extends']) as $template) {
					self::parseTemplate(APP_DIR . '/views/' . $template . '.php', $data);
				}
			}

			// match sections
			if (preg_match_all(self::$sectionsRegex, $output, $matches)) {
				$matchedSectionTitles = $matches['sections'];
				$sections = preg_split("!@(section|endsection)(\('(.*)'\))?!", $output);
				$sections = array_values(array_filter($sections, function ($a) {
					$a = trim($a);
					return ($a) ? $a : false;
				}));

				foreach ($sections as $k => $v) {
					$toAdd['sections'][$matchedSectionTitles[$k]] = $v;
				}
			}
			self::$data['views'][$file] = $toAdd;
			return true;
		}
	}

	public static function compile()
	{
		$views = array_reverse(self::$data['views']);

		foreach ($views as $view => $data) {
			if (isset($data['yields']) && isset($data['sections']['content'])) {
				foreach ($data['yields'] as $section => $v) {
					foreach ($views as $subview => $subdata) {
						if ($subview != $view) {
							$views[$view]['sections'][$section] .= $views[$subview]['sections'][$section];
						}
					}
				}
			}
		}

		foreach ($views as $view => $data) {
			if (isset($data['yields']) && isset($data['sections'][self::$_privateTemplateName])) {

				$sections = array_diff_key($data['sections'], [self::$_privateTemplateName => '']);

				foreach ($sections as $section => $content) {
					$views[$view]['sections'][self::$_privateTemplateName] = str_replace("@yield('$section')", $content, $views[$view]['sections'][self::$_privateTemplateName]);
				}

				self::$data['compiled'] .= $views[$view]['sections'][self::$_privateTemplateName];
			}
		}
	}

}