<?php

namespace App\Extensions\EnvironmentPanel\Actions;

use App\Facades\Telemetry;
use App\Models\Assets\Device;
use App\Models\Telemetry\Kv;
use App\Extensions\BaseClass;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * @title Public panel
 * @package App\Extensions\SwitchButton
 */
class Normal extends BaseClass
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
        //Initial will only be true when the client actively sends a message
        if ($initial) {
            $switches = Arr::get($data, 'message.switch');
            if ($switches) {
                $token = Device::getTokenByDeviceId($device_id[0]);

                collect($switches)->each(function ($value, $field) use ($token, $fields) {
                    switch (Arr::get($fields, $field . '.type')) {
                        case \App\Extensions\BaseClass::FIELD_TYPE_SWITCH:
                        case 'auto_switch':
                            //enable
                            if ($value === 1) {
                                Telemetry::sendDataToClient($token, [
                                    $field => '1'
                                ]);
                                //Insert data for next display
                                Kv::insertByToken($token, [$field => $value]);
                            }
                            //disable
                            if ($value === 0) {
                                Telemetry::sendDataToClient($token, [
                                    $field => '0'
                                ]);
                                //Insert data for next display
                                Kv::insertByToken($token, [$field => $value]);
                            }
                            break;
                        case \App\Extensions\BaseClass::FIELD_TYPE_SCROLL:
                            Telemetry::sendDataToClient($token, [
                                $field => $value
                            ]);
                            //Insert data for next display
                            Kv::insertByToken($token, [$field => $value]);
                            break;
                        default:
                            break;
                    }
                });
            }
        }

        $data = parent::main($device_id, $data, $fields, $initial);

        //overview special fields
        collect($fields)->each(function ($val, $field) use ($device_id, &$data) {
            if (is_array($val) && isset($val['type'])) {
                switch ($val['type']) {
                    case \App\Extensions\BaseClass::FIELD_TYPE_SWITCH:
                        $data[$field] = Kv::getLatestValue($device_id[0], $field, 'offline');
                        break;
                    default:
                        break;
                }
            }
        });

        //auto switch
        $data['auto_switch'] = Kv::getLatestValue($device_id[0], 'auto_switch', 0);

        return $data;
    }
}
