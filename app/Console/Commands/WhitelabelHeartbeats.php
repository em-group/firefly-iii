<?php

namespace FireflyIII\Console\Commands;


use FireflyIII\Models\Whitelabel;
use Illuminate\Console\Command;

class WhitelabelHeartbeats extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whitelabels:heartbeats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a heartbeat for each of the whitelabels, to assure it\'s reachable';

    public function handle()
    {
        $whitelabels = Whitelabel::with('config')->get();

        foreach ($whitelabels as $whitelabel) {
            /** @var Whitelabel $whitelabel */
            \FireflyIII\Http\Middleware\Whitelabel::setConfig($whitelabel);
            try {
                $this->call('emhub:heartbeat');
                $this->info('Heartbeat for '. $whitelabel->name . ' successful');
            } catch (\Exception $e) {
                $this->warn('Heartbeat for '. $whitelabel->name . ' failed');
            }
        }
    }

}