<?php

namespace Gravel\Core;

abstract class TemplateEngine
{
	public static $data = [
		'views'    => [],
		'compiled' => ''
	];

	public static $includeRegex = "!@include\('(?<includes>.*)'\)!";
	public static $yieldRegex = "!@yield\('(?<yields>.*)'\)!";
	public static $extendsRegex = "!@extends\('(?<extends>.*)'\)!";
	public static $sectionsRegex = "!@section\('(?<sections>.*)'\)!";
	private static $_privateTemplateName = 'gravel_private_template';
	private static $_pageTitle = 'Gravel';

	/**
	 * @return string
	 */
	public static function getPageTitle()
	{
		return static::$_pageTitle;
	}

	/**
	 * @param string $pageTitle
	 */
	public static function setPageTitle($pageTitle)
	{
		static::$_pageTitle = $pageTitle;
	}



	public static function parseTemplate($file, $data = [], $isInclude = false)
	{
		extract($data);

		ob_start();
		require($file);
		$output = ob_get_clean();
		$file = substr($file, strlen(APP_DIR . '/views/'), -4);

		if (!preg_match("!@(extends|section|endsection|yield|include)!U", $output) && !$isInclude) {
			self::$data['compiled'] = $output;
		} else {
			$toAdd = [];

			if ($isInclude) {
				$toAdd['sections'][self::$_privateTemplateName] = $output;
			}

			// match yields
			if (preg_match_all(self::$yieldRegex, $output, $matches)) {
				foreach ($matches['yields'] as $yield) {
					$toAdd['yields'][$yield] = true;
					$toAdd['sections'][self::$_privateTemplateName] = $output;
					$toAdd['sections'][$yield] = '';
				}
			}

			// match includes
			if (preg_match_all(self::$includeRegex, $output, $matches)) {
				foreach ($matches['includes'] as $include) {
					$toAdd['includes'][$include] = true;
					self::parseTemplate(APP_DIR . '/views/' . $include . '.php', $data, true);
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
		}
		return true;
	}

	public static function compile()
	{

		$views = array_reverse(self::$data['views']);

		// compile includes
		foreach ($views as $view => $data) {
			if (isset($data['includes'])) {
				foreach ($data['includes'] as $section => $v) {
					foreach ($views as $subview => $subdata) {
						if ($subview != $view && isset($views[$subview]['sections'][self::$_privateTemplateName])) {
							$views[$view]['includes'][$section] = $views[$subview]['sections'][self::$_privateTemplateName];
						}
					}
				}
			}
		}

		// build includes
		foreach ($views as $view => $data) {
			if (isset($data['includes'])) {
				$sections = array_diff_key($data['includes'], [self::$_privateTemplateName => '']);
				foreach ($sections as $section => $content) {
					$views[$view]['sections'][self::$_privateTemplateName] = str_replace("@include('$section')", $content, $views[$view]['sections'][self::$_privateTemplateName]);
				}
			}
		}

		// compile yields
		foreach ($views as $view => $data) {
			if (isset($data['yields'])) {
				foreach ($data['yields'] as $section => $v) {
					foreach ($views as $subview => $subdata) {
						if ($subview != $view && isset($views[$subview]['sections'][$section])) {
							$views[$view]['sections'][$section] = $views[$subview]['sections'][$section];
						}
					}
				}
			}
		}

		// build yields
		foreach ($views as $view => $data) {
			if (isset($data['yields']) ) {
				$sections = array_diff_key($data['sections'], [self::$_privateTemplateName => '']);
				foreach ($sections as $section => $content) {
					$views[$view]['sections'][self::$_privateTemplateName] = str_replace("@yield('$section')", $content, $views[$view]['sections'][self::$_privateTemplateName]);
				}
				self::$data['compiled'] = $views[$view]['sections'][self::$_privateTemplateName];
			}
		}

	}

}