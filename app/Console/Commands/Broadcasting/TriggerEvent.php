<?php

declare(strict_types=1);

namespace App\Console\Commands\Broadcasting;

use App\Events\PrivateMessageTriggered;
use App\Events\PublicMessageTriggered;
use Illuminate\Console\Command;

final class TriggerEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:broadcasting:trigger-event {--private}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger a public event sample';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $event =
            $this->option('private')
            ? new PrivateMessageTriggered()
            : new PublicMessageTriggered();

        broadcast($event);
    }
}
