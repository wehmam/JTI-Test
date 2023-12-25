<?php
namespace App\Providers;

use Pusher\Pusher;

class PusherService {

    protected $appKey, $appSecret, $appId;

    public function __construct() {
        $this->appKey = env('PUSHER_APP_KEY');
        $this->appSecret = env('PUSHER_APP_SECRET');
        $this->appId = env('PUSHER_APP_ID');
    }

    public function push($channel = '', $event = '', $data = [], $options = []){
        try {
            if (empty($options)) {
                $options = [
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'useTLS' => false
                ];
            }
            $pusher = new Pusher($this->appKey,$this->appSecret, $this->appId, $options);
            $pusher->trigger($channel, $event, $data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
