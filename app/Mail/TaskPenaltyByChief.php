<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskPenaltyByChief extends Mailable
{
    use Queueable, SerializesModels;
    public $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->task = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('da@to-moore.com')->subject('У вас штраф за невыполнение задачи от Шефа!"
')->markdown('emails.manager.task_penalty_by_chief');
    }
}
