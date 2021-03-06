<?php

/**
 * @copyright Copyright &copy; Karol Kaminski, 2014
 * @package yii2-nestable
 * @version 1.0.0
 */

namespace iksnimak\nestable;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Create nestable lists using drag & drop for Yii 2.0.
 * Based on jquery.nestable.js plugin.
 *
 * @see http://dbushell.github.io/Nestable/
 * @author Karol Kaminski <kkaminski1981@gmail.com>
 * @since 1.0
 */
class Nestable extends \kartik\widgets\Widget {

	// TODO: Implement default nestable list without handle
	const TYPE_LIST = 'list';

	const TYPE_WITH_HANDLE = 'list-handle';

	/**
	 * @var string the type of the sortable widget
	 * Defaults to Nestable::TYPE_WITH_HANDLE
	 */
	public $type = self::TYPE_WITH_HANDLE;

	/**
	 * @var string, the handle label, this is not HTML encoded
	 */
	public $handleLabel = '<div class="dd-handle dd3-handle">&nbsp;</div>';

	/**
	 * @var array the HTML attributes to be applied to list.
	 * This will be overridden by the [[options]] property within [[$items]].
	 */
	public $listOptions = [];

	/**
	 * @var array the HTML attributes to be applied to all items.
	 * This will be overridden by the [[options]] property within [[$items]].
	 */
	public $itemOptions = [];

	/**
	 * @var array the sortable items configuration for rendering elements within the sortable
	 * list / grid. You can set the following properties:
	 * - content: string, the list item content (this is not HTML encoded)
	 * - disabled: bool, whether the list item is disabled
	 * - options: array, the HTML attributes for the list item.
	 */
	public $items = [];

	/**
	 * Initializes the widget
	 */
	public function init() {
		parent::init();
		Html::addCssClass($this->options, 'dd');
		$this->registerAssets();
		echo Html::beginTag('div', $this->options);
		if (count($this->items) === 0) {
			echo Html::tag('div', '', ['class' => 'dd-empty']);
		}
	}

	/**
	 * Runs the widget
	 *
	 * @return string|void
	 */
	public function run() {
		if (count($this->items) > 0) {
			echo Html::beginTag('ol', ['class' => 'dd-list']);
			echo $this->renderItems();
			echo Html::endTag('ol');
		}
		echo Html::endTag('div');
	}

	/**
	 * Render the list items for the sortable widget
	 *
	 * @return string
	 */
	protected function renderItems($_items = NULL) {
		$_items = is_null($_items) ? $this->items : $_items;
		$items = '';
		foreach ($_items as $item) {
			$options = ArrayHelper::getValue($item, 'options', []);
			$options = ArrayHelper::merge($this->itemOptions, $options);
			$content = $this->handleLabel;
			$content .= ArrayHelper::getValue($item, 'content', '');
			$children = ArrayHelper::getValue($item, 'children', []);
			if (!empty($children)) {
					// recursive rendering children items
				$content .= Html::beginTag('ol', ['class' => 'dd-list']);
				$content .= $this->renderItems($children);
				$content .= Html::endTag('ol');
			}

			$items .= Html::tag('li', $content, $options) . PHP_EOL;
		}
		return $items;
	}

	/**
	 * Register client assets
	 */
	public function registerAssets() {
		$view = $this->getView();
		NestableAsset::register($view);
		$this->registerPlugin('nestable');
		$id = '$("#' . $this->options['id'] . '")';
	}

	/**
	 * @param $partial
	 * @param $arguments
	 */
	public function renderContent($partial, $arguments) {
		return $this->render($partial, $arguments);
	}

	/**
	 * @param $activeQuery \yii\db\ActiveQuery
	 * @return array
	 */
	public static function prepareItems($activeQuery, $partial = NULL, $renderer = NULL) {
		$items = [];
		foreach ($activeQuery->all() as $item) {
			if ($partial != NULL) {
				$content = $renderer->render($partial, ['item' => $item]);
			} else {
				$content = $item->name;
			}
			$childrenItems = static::prepareItems($item->getChildren(), $partial, $renderer);

			$items[] = [
				'content' => $content,
				'options' => ['class' => 'dd-item dd3-item', 'data-id' => $item->id],
				'children' => static::prepareItems($item->getChildren(), $partial, $renderer)
			];
		}
		return $items;
	}
}