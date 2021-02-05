<?php

namespace App\Mail;

use App\Meta;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportExport extends Mailable
{
    use Queueable, SerializesModels;

    private $report;
    private $meta;

    public $subject = 'Dein Bericht wurde erstellt';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->meta = Meta::all()->pluck('value', 'name');
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.report', ['meta'=>$this->meta])
            ->attachData($this->report, 'Report' . '.csv', ['mime' => 'text/csv']);
    }
}
