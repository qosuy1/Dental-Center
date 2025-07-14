<?php

namespace App\Jobs;

use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ProcessDeleteImage implements ShouldQueue
{
    use Queueable;

    private $model;
    private $public_id;


    /**
     * Create a new job instance.
     */
    public function __construct(string $public_id = "cloudinary_public_id")
    {
        $this->public_id = $public_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new UploadApi())->destroy($this->public_id);
    }
}
