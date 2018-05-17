<?php

namespace Arkade\ElasticBeanstalkWorker;

use Illuminate\Queue;
use Illuminate\Contracts;
use Illuminate\Container\Container;

class ElasticBeanstalkJob extends Queue\Jobs\Job implements Contracts\Queue\Job
{
    /**
     * Job ID.
     *
     * @var string
     */
    protected $jobId;

    /**
     * Number of attempts.
     *
     * @var int
     */
    protected $attempts;

    /**
     * Raw body.
     *
     * @var string
     */
    protected $rawBody;

    /**
     * ElasticBeanstalkJob constructor.
     *
     * @param  Container  $container
     * @param  string  $jobId
     * @param  int  $attempts
     * @param  string  $rawBody
     */
    public function __construct(Container $container, string $jobId, int $attempts, string $rawBody)
    {
        $this->container = $container;
        $this->jobId = $jobId;
        $this->attempts = $attempts;
        $this->rawBody = $rawBody;
    }

    /**
     * Get the job identifier.
     *
     * @return string
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts()
    {
        return $this->attempts;
    }

    /**
     * Get the raw body of the job.
     *
     * @return string
     */
    public function getRawBody()
    {
        return $this->rawBody;
    }
}