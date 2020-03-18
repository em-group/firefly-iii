<?php
/**
 * Created by PhpStorm.
 * User: zifle
 * Date: 2019-11-26
 * Time: 3:10 PM
 */

namespace FireflyIII\Mail;

use FireflyIII\Http\Middleware\Whitelabel;
use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Contracts\Queue\Factory as Queue;
use Illuminate\Mail\Mailable;

abstract class WhitelabelMailable extends Mailable {

    protected $whitelabel_id;

    private function _setFrom()
    {
        if (empty($this->from)) {
            $this->from(config('mail.from.address'), config('mail.from.name'));
        }
    }

    public function send(MailerContract $mailer)
    {
        // Inject whitelabel config from saved id
        if (!empty($this->whitelabel_id)) {
            $whitelabel = \FireflyIII\Models\Whitelabel::find($this->whitelabel_id);
            Whitelabel::setConfig($whitelabel);
        }
        $this->_setFrom();
        parent::send($mailer);
    }

    public function queue(Queue $queue)
    {
        $this->whitelabel_id = config('whitelabel.id');
        $this->_setFrom();
        return parent::queue($queue);
    }

    public function later($delay, Queue $queue)
    {
        $this->whitelabel_id = config('whitelabel.id');
        $this->_setFrom();
        return parent::later($delay, $queue);
    }
}