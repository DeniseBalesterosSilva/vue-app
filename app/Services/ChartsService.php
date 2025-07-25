<?php

namespace App\Services;

use Asantibanez\LivewireCharts\Models\PieChartModel;
class ChartsService
{
    public function donutChart($title, $data, $jsonConfig = null, $colors = null)
    {
        $chart = (new PieChartModel())
            ->setTitle($title)
            ->setType('donut')
            ->setAnimated(true)
            ->withDataLabels()
            ->setJsonConfig($this->setJsonConfig($jsonConfig));

        $colors = $this->setColors($colors);

        foreach($data as $key => $value) {
            $chart->addSlice($value[0], $value[1], $colors[$key]);
        }

        return $chart;
    }

    protected function setJsonConfig($jsonConfig = null)
    {
        if($jsonConfig) {
            return $jsonConfig;
        }

        return [
            'plotOptions' => [
                    'pie' => [
                        'donut' => [
                            'labels' => [
                                'show' => true,
                                'name' => ['show' => true,'fontSize' => '14px','color' => '#555','offsetY' => -10],
                                'value' => ['show' => true,'fontSize' => '14px','color' => '#333','offsetY' => 10],
                                'total' => ['show' => true,'label' => 'Total','color' => '#555','fontSize' => '16px']
                            ]
                        ]
                    ]
                ]
        ];
    }


    protected function setColors($colors = null)
    {
        if($colors) {
            return $colors;
        }

        return ['#66DA26','#90cdf4','#A855F7','#FFDB58'];
    }
}