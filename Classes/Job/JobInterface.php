<?php
namespace Jobqueue\Common\Job;

/*                                                                        *
 * This script belongs to the FLOW3 package "Jobqueue.Common".                *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Job interface
 */
interface JobInterface {

	/**
	 * Execute the job
	 *
	 * A job should finish itself after successful execution using the queue methods.
	 *
	 * @param \Jobqueue\Common\Queue\QueueInterface $queue
	 * @return boolean TRUE if the job was executed successfully and the message should be finished
	 */
	public function execute(\Jobqueue\Common\Queue\QueueInterface $queue);

	/**
	 * Injects the original message of the job
	 *
	 * @param \Jobqueue\Common\Queue\Message $message The original message
	 * @return void
	 */
	public function setMessage(\Jobqueue\Common\Queue\Message $message);

	/**
	 * Get the original message of the job
	 *
	 * @return \Jobqueue\Common\Queue\Message The original message
	 */
	public function getMessage();

}
?>