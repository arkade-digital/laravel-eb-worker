<?php

namespace Arkade\ElasticBeanstalkWorker;

use Illuminate\Queue;
use Illuminate\Http\Request;
use Illuminate\Contracts\Console;
use Illuminate\Routing\Controller;

class QueueController extends Controller
{
    /**
     * Receive queue job from SQS.
     *
     * @param  Request  $request
     * @param  Queue\Worker  $worker
     * @return \Illuminate\Http\JsonResponse
     */
    public function receive(Request $request, Queue\Worker $worker)
    {
        $job = new ElasticBeanstalkJob(
            app(),
            (string) $request->header('X-Aws-Sqsd-Msgid'),
            (int) $request->header('X-Aws-Sqsd-Receive-Count'),
            (string) $request->getContent()
        );

        $workerOptions = new Queue\WorkerOptions(0, 1024, 3600);

        $worker->process('sqs', $job, $workerOptions);

        return response()->json(['message' => 'Job processed.']);
    }

    /**
     * Run task scheduler.
     *
     * @param  Console\Kernel  $kernel
     * @return \Illuminate\Http\JsonResponse
     */
    public function schedule(Console\Kernel $kernel)
    {
        $kernel->call('schedule:run');

        return response()->json(['message' => 'Schedule run.']);
    }
}