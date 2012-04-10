<?php
namespace Jobqueue\Common\Tests\Unit\Fixtures;

/*                                                                        *
 * This script belongs to the FLOW3 package "Jobqueue.Common".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Test queue
 *
 * A simple in-memory message queue for unit tests.
 */
class TestQueue implements \Jobqueue\Common\Queue\QueueInterface {

	/**
	 * @var array
	 */
	protected $messages = array();

	/**
	 * @var array
	 */
	protected $processing = array();

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var array
	 */
	protected $options;

	/**
	 *
	 * @param string $name
	 * @param array $options
	 */
	public function __construct($name, $options) {
		$this->name = $name;
		$this->options = $options;
	}

		/**
	 * @param \Jobqueue\Common\Queue\Message $message
	 * @return void
	 */
	public function finish(\Jobqueue\Common\Queue\Message $message) {
		unset($this->processing[$message->getIdentifier()]);
	}

	/**
	 * @return \Jobqueue\Common\Queue\Message
	 */
	public function peek() {
		return count($this->messages) > 0 ? $this->messages[0] : NULL;
	}

	/**
	 * @param \Jobqueue\Common\Queue\Message $message
	 * @return void
	 */
	public function publish(\Jobqueue\Common\Queue\Message $message) {
			// TODO Unique identifiers
		$this->messages[] = $message;
	}

	/**
	 * @param integer $timeout
	 * @return \Jobqueue\Common\Queue\Message
	 */
	public function waitAndReserve($timeout = 60) {
		$message = array_shift($this->messages);
		if ($message !== NULL) {
			$this->processing[$message->getIdentifier()] = $message;
		}
		return $message;
	}

	/**
	 *
	 * @param integer $timeout
	 * @return \Jobqueue\Common\Queue\Message
	 */
	public function waitAndTake($timeout = 60) {
		$message = array_shift($this->messages);
		return $message;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @return array
	 */
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * @return array
	 */
	public function getProcessing() {
		return $this->processing;
	}

}
?>