<?php

namespace App\Extensions\SwitchButton\Actions;

use App\Facades\Telemetry;
use App\Models\Assets\Device;
use App\Models\Telemetry\Kv;
use App\Extensions\BaseClass;
use Illuminate\Support\Arr;

/**
 * Class Button
 * @title switch
 * @package App\Extensions\SwitchButton
 */
class Button extends BaseClass
{
    /**
     * @param array $device_id
     * @param array $data
     * @param array $fields
     * @param bool $initial
     * @return array
     */
    public function main(array $device_id, array $data, array $fields, bool $initial): array
    {
        if ($initial) {
            $message = Arr::get($data, 'message', '');
            if ($message) {
                $token = Device::getTokenByDeviceId($device_id[0]);
                $enable = Arr::get($message, 'enable');
                if ($enable === 1) {
                    Telemetry::sendDataToClient($token, [
                        "enable" => 1
                    ]);
                    Kv::insertByToken($token, ['enable' => $enable]);
                }
                if ($enable === 0) {
                    Telemetry::sendDataToClient($token, [
                        "enable" => 0
                    ]);
                    Kv::insertByToken($token, ['enable' => $enable]);
                }
            }
        }

        return [
            'enable' => Kv::getLatestValue($device_id[0], 'enable', 0)
        ];
    }
}
