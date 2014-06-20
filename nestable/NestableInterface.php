<?php

/**
 * @copyright Copyright &copy; Karol Kaminski, 2014
 * @package yii2-nestable
 * @version 1.0.0
 */

namespace iksnimak\nestable;

/**
 * NestableInterface is the interface that should be implemented by a class which
 * contain nested elements.
 *
 * This interface can typically be implemented by a menu items model class.
 *
 * Example: //TODO
 * ~~~
 * class MenuItem implements Nestable
 * {
 *    ...
 * }
 * ~~~
 *
 * @author Karol Kaminski
 * @since 2.0
 */
interface NestableInterface
{
	/**
	 * Returns an ActiveRecord object of all child elements of current model.
	 * @return \yii\db\ActiveRecord
	 */
	public function getChildren();
}
