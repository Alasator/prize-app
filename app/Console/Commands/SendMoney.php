<?php
namespace App\Console\Commands;

use App\Models\UserPrize;
use Illuminate\Console\Command;

include_once 'public\LiqPay.php';

class SendMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-money';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send money to ppl';

    const LIMIT = 100;

    public function handle()
    {
        $this->info('Start');

        $public_key = 'sandbox_xxxxxxxxxxxxxx';
        $private_key = 'sandbox_xxxxxxxxxxxxxxx';

        $liqpay = new \LiqPay($public_key, $private_key);

        UserPrize::where('type', '=', 1)->where('sent_status', '=', 0)->chunk(self::LIMIT, function ($prizes)  use ($liqpay) {

            foreach ($prizes as $prize) {

                try {
                $res = $liqpay->api("request", array(
                    'action'         => 'pay',
                    'version'        => '3',
                    'phone'          => $prize->phone_number,
                    'amount'         => $prize->value,
                    'currency'       => 'USD',
                    'description'    => 'send money for lottery winner',
                    'order_id'       => 'order_id_1',
                    'card'           => $prize->bank_card,
                    'card_exp_month' => $prize->card_exp_month,
                    'card_exp_year'  => $prize->card_exp_year,
                    'card_cvv'       => $prize->card_cvv
                ));
                if($res->status === 200) {
                    $prize->sent_status = 1;
                    $prize->save();
                }
                }
                catch(\Exception $e) {
                    Log::warn('failed to send money for user.', ['id' => $prize->user_id]);
                }
            }

        });

        $this->info('Done');
    }
}
