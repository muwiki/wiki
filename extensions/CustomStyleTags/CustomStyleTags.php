<?php

use Nette\Utils\Html;

if (!defined('MEDIAWIKI')) {
	die('This is a mediawiki extensions and can\'t be run from the command line.');
}

class CustomStyleTags
{

	public static $tags = [
		'definition' => [
			'title' => 'Definice',
			'class' => 'definition',
		],
		'sentence' => [
			'title' => 'Věta',
			'class' => 'sentence',
		],
	];

	public static function parserFirstCallInit(Parser $parser)
	{
		foreach (self::$tags as $customTag => $meta) {
			$parser->setHook(strtolower($customTag), function ($text, array $params, Parser $parser, PPFrame $frame) use ($customTag, $meta) {
				return self::buildTag($text, $params, $meta);
			});
		}

		return true;
	}

	private static function buildTag($text, array $params, array $meta)
	{
		// create base tag
		$el = Html::el((!empty($meta['tag']) ? $meta['tag'] : 'div'))
			->addAttributes(array_diff_key($meta, ['title' => false, 'tag' => false]))
			->addAttributes($params);

		// process title line
		$title = array_key_exists('title', $el->attrs) ? $el->attrs['title'] : $meta['title'];
		unset($el->attrs['title']);
		$el->add(Html::el('div', ['class' => 'title'])->setText($title));

		// process content
		$el->add(Html::el('div', ['class' => 'content'])->setHtml(trim($text)));

		// render
		return (string) $el->addClass('customTag');
	}

}
