<?php

/**
 * @copyright Copyright &copy; Arno Slatius 2015
 * @package yii2-nestable
 * @version 1.0.0
 */

namespace slatiusa\nestable;

/**
 * Nestable bundle for \iksnimak\sortable\Sortable
 *
 * @author Karol Kaminski <kkaminski1981@gmail.com>
 * @since 1.0
 */
class NestableAsset extends \kartik\base\AssetBundle {

	public function init() {
		$this->setSourcePath(__DIR__ . '/../assets');
        $this->setupAssets('js', ['js/jquery.nestable']);
		$this->setupAssets('css', ['css/nestable']);
		parent::init();
	}

}