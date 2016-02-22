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

	public static function run(Parser $parser)
	{
		Hooks::register('ParserBeforeStrip', get_called_class() . '::transformTags');

		return true;
	}

	public static function transformTags(Parser $parser, &$text)
	{
		foreach (self::$tags as $customTag => $meta) {
			$tag = preg_quote($customTag);
			// $pattern = '~<' . $customTag . '(?P<attrs>[^>]*)>(?P<content>(?:[^<]*+(?:(?!<' . $customTag . '[^>]*>)|(?R))*+)*+)</' . $customTag . '>~i';
			$pattern = '~<' . $tag . '(?P<attrs>[^>]*)>(?P<content>.*?)</' . $tag . '>~is';
			$text = preg_replace_callback($pattern, function (array $m) use ($customTag, $meta) {
				// create base tag
				$el = Html::el((!empty($meta['tag']) ? $meta['tag'] : 'div') . ($m['attrs'] !== '' ? ' ' . $m['attrs'] : ''))
					->addAttributes(array_diff_key($meta, ['title' => false, 'tag' => false]));

				// process title line
				$title = array_key_exists('title', $el->attrs) ? $el->attrs['title'] : $meta['title'];
				unset($el->attrs['title']);
				$el->add(Html::el('div', ['class' => 'title'])->setText($title));

				// process content
				$el->add(Html::el('div', ['class' => 'content'])->setHtml(trim($m['content'])));

				// render
				return (string) $el->addClass('customTag');
			}, $text);
		}

		return true;
	}

}
