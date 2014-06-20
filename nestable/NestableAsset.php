<?php

/**
 * @copyright Copyright &copy; Karol Kaminski, 2014
 * @package yii2-nestable
 * @version 1.0.0
 */

namespace iksnimak\nestable;

/**
 * Nestable bundle for \iksnimak\sortable\Sortable
 *
 * @author Karol Kaminski <kkaminski1981@gmail.com>
 * @since 1.0
 */
class NestableAsset extends \kartik\widgets\AssetBundle {

	public function init() {
		$this->setSourcePath(__DIR__ . '/../assets');
		$this->setupAssets('js', ['js/jquery.nestable']);
		parent::init();
	}

}