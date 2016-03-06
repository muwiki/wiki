<?php

use Nette\Utils\Html as NHtml;
use \Nette\Utils\Strings as NStrings;

if (!defined('MEDIAWIKI')) {
	die('This is a mediawiki extensions and can\'t be run from the command line.');
}

class CustomStyleTags
{

	public static $tags = [
		'assumption' => [
			'title' => 'Předpoklad',
			'class' => 'assumption',
		],
		'axiom' => [
			'title' => 'Axiom',
			'class' => 'axiom',
		],
		'conjecture' => [
			'title' => 'Conjecture',
			'class' => 'conjecture',
		],
		'corollary' => [
			'title' => 'Důsledek',
			'class' => 'corollary',
		],
		'definition' => [
			'title' => 'Definice',
			'class' => 'definition',
		],
		'example' => [
			'title' => 'Příklad',
			'class' => 'example',
		],
		'lemma' => [
			'title' => 'Lemma',
			'class' => 'lemma',
		],
		'notation' => [
			'title' => 'Označení',
			'class' => 'notation',
		],
		'proof' => [
			'title' => 'Důkaz',
			'class' => 'proof',
		],
		'proposition' => [
			'title' => 'Tvrzení',
			'class' => 'proposition',
		],
		'remark' => [
			'title' => 'Poznámka',
			'class' => 'remark',
		],
		'result' => [
			'title' => 'Výsledek',
			'class' => 'result',
		],
		'theorem' => [
			'title' => 'Věta',
			'class' => 'sentence',
		],
	];

	public static $attrWhitelist = [
		'title' => true,
		'id' => true,
	];

	public static function parserFirstCallInit(Parser $parser)
	{
		foreach (self::$tags as $customTag => $meta) {
			$parser->setHook(strtolower($customTag), function ($text, array $params, Parser $parser, PPFrame $frame) use ($customTag, $meta) {
				return self::buildTag($text, $params, $meta, $parser, $frame);
			});
		}

		return true;
	}

	private static function buildTag($text, array $params, array $meta, Parser $parser, PPFrame $frame)
	{
		// create base tag
		$el = NHtml::el((!empty($meta['tag']) ? $meta['tag'] : 'div'))
			->addAttributes(array_diff_key($meta, ['title' => false, 'tag' => false]))
			->addAttributes(array_intersect_key($params, self::$attrWhitelist));

		// custom id
		$el->addAttributes([
			'id' => array_key_exists('id', $el->attrs)
				? sprintf('cst-%s-%s', $el->getName(), NStrings::webalize($el->attrs['id']))
				: false
		]);

		// process title line
		$title = array_key_exists('title', $el->attrs) ? $el->attrs['title'] : $meta['title'];
		unset($el->attrs['title']);
		$el->add(NHtml::el('div', ['class' => 'title'])->setText($title));

		// process content
		$text = $parser->recursiveTagParse($text, $frame);
		$el->add(NHtml::el('div', ['class' => 'content'])->setHtml(trim($text)));

		// render
		return (string) $el->addClass('customTag');
	}

}
