<?php


namespace App\Extensions\Gps\Actions;


use App\Models\Assets\Asset;
use App\Models\Assets\Device;
use App\Models\Telemetry\Kv;
use App\Extensions\BaseClass;
use Illuminate\Support\Facades\Log;

/**
 * Class Track
 * @title track
 * @package App\Extensions\Tahs
 */
class Track extends BaseClass
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
        return $this->getTrackData($device_id, $data['config']['latestTime'], $data['config']['startTs'], $data['config']['endTs'], $data['config']['interval'], $data['config']['operator'], $fields);
    }

    /**
     * Track data query
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
    private function getTrackData(array $device_id, int $latestTime, int $startTs, int $endTs, int $interval, string $operator, array $fields, int $limit = -1): array
    {
        if (!$latestTime) {
            $latestTime = 60; //default 10 mins
        }

        $timing[] = ['ts', '>=', \App\Facades\Telemetry::microtime() - $latestTime * 60 * 1000];

        $data = [];

        //Query single device track
        $longitudes = Kv::select('entity_id', 'ts', 'dbl_v')->where($timing)->where(['entity_id' => $device_id[0], 'entity_type' => 'ASSET', 'key' => 'longitude'])->orderBy('ts', 'asc')->pluck('dbl_v', 'ts');
        $latitudes = Kv::select('entity_id', 'ts', 'dbl_v')->where($timing)->where(['entity_id' => $device_id[0], 'entity_type' => 'ASSET', 'key' => 'latitude'])->orderBy('ts', 'asc')->pluck('dbl_v', 'ts');
        if (!empty($longitudes)) {
            foreach ($longitudes as $ts => $val) {
                if (isset($latitudes[$ts])) {
                    if ($val && $latitudes[$ts]) {
                        $data[] = [
                            $val, //longitude
                            $latitudes[$ts] //latitude
                        ];
                    }
                }
            }
        }
        return $data;
    }
}
