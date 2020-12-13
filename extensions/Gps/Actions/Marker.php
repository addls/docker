<?php


namespace App\Extensions\Gps\Actions;


use App\Facades\Telemetry;
use App\Models\Assets\Asset;
use App\Models\Assets\Device;
use App\Models\Telemetry\Kv;
use App\Extensions\BaseClass;
use Illuminate\Support\Arr;

/**
 * Class marker
 * @title latest data
 * @package App\Extensions\Tahs
 */
class Marker extends BaseClass
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
        // save custom data
        if ($initial) {
            collect(['soil_nitrogen', 'soil_temperature', 'soil_humidity', 'frequency'])->each(function ($key) use ($data, $device_id) {
                $val = Arr::get($data, 'message.' . $key, 0);
                if ($val) {
                    Kv::insertByDeviceID($device_id[0], [
                        $key => $val
                    ]);

                    //send frequency to tcp client
                    if ($key == 'frequency') {
                        Telemetry::sendDataToTCPClient(Device::getTokenByDeviceId($device_id[0]), ['frequency' => $val]);
                    }
                }
            });
        }

        return [
            'frequency' => Kv::getLatestValue($device_id[0], 'frequency', 1), // second
            'assets_total' => count($device_id),
            'number' => Asset::where('id', $device_id[0])->value('name') . ': ' . strstr($device_id[0], '-', true),
            'temperature' => Kv::getLatestValue($device_id[0], 'temperature', 0),
            'soil' => [
                'nitrogen' => Kv::getLatestValue($device_id[0], 'soil_nitrogen', 0),
                'temperature' => Kv::getLatestValue($device_id[0], 'soil_temperature', 0),
                'humidity' => Kv::getLatestValue($device_id[0], 'soil_humidity', 0)
            ],
            'coordinate' => $this->getCoordinateData($device_id, $data['config']['latestTime'], $data['config']['startTs'], $data['config']['endTs'], $data['config']['interval'], $data['config']['operator'], $fields)
        ];
    }

    /**
     * latest coordinate
     * @param array $device_id
     * @param int $latestTime last minutes
     * @param int $startTs millisecond
     * @param int $endTs millisecond
     * @param int $interval
     * @param string $operator
     * @param array $fields
     * @param int $limit
     * @return array
     */
    private function getCoordinateData(array $device_id, int $latestTime, int $startTs, int $endTs, int $interval, string $operator, array $fields, int $limit = -1): array
    {
        $data = [];
        foreach ($device_id as $asset_id) {
            $longitude = Kv::where(['entity_id' => $asset_id, 'entity_type' => 'ASSET', 'key' => 'longitude'])->where('dbl_v', '!=', 0)->orderBy('ts', 'desc')->value('dbl_v');
            $latitude = Kv::where(['entity_id' => $asset_id, 'entity_type' => 'ASSET', 'key' => 'latitude'])->where('dbl_v', '!=', 0)->orderBy('ts', 'desc')->value('dbl_v');
            //latest coordinate
            if ($longitude && $latitude) {
                $data[] = [
                    'name' => Asset::where('id', $asset_id)->value('name'), //asset name
                    "longitude" => $longitude,
                    "latitude" => $latitude
                ];
            }
        }
        return $data;
    }
}
