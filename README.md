# Elastic Beanstalk worker for Laravel

This package adds two endpoints to your application to receive and process Elastic Beanstalk queue requests.

- Queue receiver - `/queue/receive`<br />
This endpoint receives SQS jobs from the Elastic Beanstalk daemon before processing them using the Laravel queue worker.

- Queue scheduler - `/queue/schedule`<br />
This endpoint can be configured in Elastic Beanstalk to be called every minute. It will execute your Laravel scheduled tasks.

## Installation

```
composer require arkade/laravel-eb-worker
```