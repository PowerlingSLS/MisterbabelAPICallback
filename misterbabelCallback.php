<?php

class MisterbabelCallback
{
	/**
	 * @var array $job	Array containing data of the job.
	 */
	private $job;

	/**
	 * Check if keys are in the specified array.
	 * @return bool
	 */
	private function arrayKeysExists(array $keys, array $arr)
	{
		return !array_diff_key(array_flip($keys), $arr);
	}

	/**
	 * Check if POST data payload is correct.
	 * @return bool
	 */
	private function verifyPayload($payload)
	{
		$constraints = array('job_id',
							'job_reference',
							'custom_reference',
							'lc_source',
							'lc_target',
							'creation_time',
							'delivery_time',
							'title',
							'comment',
							'word_count',
							'file_url_source',
							'file_url_target',
							'review',
							'status'
							);

		if ($this->arrayKeysExists($constraints, $payload) === False)
			return False;
		else
			return True;
	}

	/**
	 * Check if POST data exist and received information are valid.
	 * @return bool
	 */
	public function verifyData()
	{
		$rawBody = file_get_contents('php://input');

		if (!isset($_POST) || empty($rawBody))
			throw new Exception("Missing POST Data");


		$rawData = json_decode($rawBody, True);

		if (empty($rawData) || $this->verifyPayload($rawData) === False)
			throw new Exception("Invalid POST Data payload");

		$job = array('job_id' => $rawData['job_id'],
					'job_reference' => $rawData['job_reference'],
					'custom_reference' => $rawData['custom_reference'],
					'lc_source' => $rawData['lc_source'],
					'lc_target' => $rawData['lc_target'],
					'creation_time' => $rawData['creation_time'],
					'delivery_time' => $rawData['delivery_time'],
					'title' => $rawData['title'],
					'comment' => $rawData['comment'],
					'word_count' => $rawData['word_count'],
					'file_url_source' => $rawData['file_url_source'],
					'file_url_target' => $rawData['file_url_target'],
					'review' => $rawData['review'],
					'status' => $rawData['status']
				);

		$this->job = $job;

		return True;
	}

	/**
	 * Get job information received.
	 * @return array
	 */
	public function getJob()
	{
		return $this->job;
	}
}

?>