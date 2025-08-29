<?php

namespace App\Actions\Location;

use App\Models\Settlement;
use Illuminate\Support\LazyCollection;
use Lorisleiva\Actions\Action;
use Orchestra\Parser\Xml\Facade as XmlParser;
use SimpleXMLElement;
use XMLReader;

class LocationImport extends Action
{
    public function handle(): void
    {
        $xmlFile = public_path('locations/index.xml');
        $reader = new XMLReader();
        $reader->open($xmlFile);

        $areas = [];
        $regions = [];
        $cities = [];
        $cityRegions = [];

        while ($reader->read()) {
            if ($reader->nodeType == XMLReader::ELEMENT && $reader->name === 'RECORD') {
                $node = new SimpleXMLElement($reader->readOuterXML());

                $areaName      = trim((string)$node->OBL_NAME);
                $regionName    = trim((string)$node->REGION_NAME);
                $cityName      = trim((string)$node->CITY_NAME);
                $cityRegionName= trim((string)$node->CITY_REGION_NAME);

                // === AREA ===
                $area = null;
                if ($areaName) {
                   if (!isset($areas[$areaName])) {
                       $area = Settlement::query()->firstOrCreate([
                           'name' => $areaName,
                           'type' => Settlement::TYPE_AREA,
                       ]);

                       $areas[$areaName] = $area->id;
                   }
                }

                // === REGION ===
                $region = null;
                if ($regionName) {
                    if(!isset($regions[$regionName])) {
                        $region = Settlement::query()->firstOrCreate([
                            'name' => $regionName,
                            'type' => Settlement::TYPE_REGION,
                            'area_id' => $areas[$areaName] ?? null,
                        ]);

                        $regions[$regionName] = $region->id;
                    }
                }

                $city = null;
                if ($cityName) {
                   if (!isset($cities[$cityName])) {
                       $city = Settlement::query()->firstOrCreate([
                           'name' => $cityName,
                           'type' => Settlement::TYPE_CITY,
                           'area_id' => $areas[$areaName] ?? null,
                           'region_id' => $regions[$regionName] ?? null,
                       ]);

                       $cities[$cityName] = $city->id;
                   }
                }

                if ($cityRegionName) {
                   if (!isset($cityRegions[$cityRegionName])) {
                       $cityRegion = Settlement::query()->firstOrCreate([
                           'name' => $cityRegionName,
                           'type' => Settlement::TYPE_CITY_REGION,
                           'area_id' => $areas[$areaName] ?? null,
                           'region_id' => $regions[$regionName] ?? null,
                           'city_id' => $cities[$cityName] ?? null,
                       ]);

                       $cityRegions[$cityRegionName] = $cityRegion->id;
                   }
                }
            }
        }

        $reader->close();
    }

}
