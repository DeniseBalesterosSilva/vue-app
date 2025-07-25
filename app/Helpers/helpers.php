<?php

function numberFormat($number, $decimals = 2)
{
    return number_format($number, $decimals, '.', '');
}

function percentformat($number)
{
    return number_format( ($number *100) , 2, '.', '');
}

function moneyFormat ($value)
{
    $moneyFormat = 'R$ '.number_format($value, 2, ",", ".");

    return $moneyFormat;
}

function exchangeRate()
{
    try{
        $exchangeResponse = execCurl("https://economia.awesomeapi.com.br/USD-BRL");
        // ask = venda; bid = compra
        return json_decode($exchangeResponse)[0]->ask;
    } catch(\Exception $err){
        return 5; //default
    }
}

function execCurl($url)
{
    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

function getPaginatedData($data, $perPage, $route)
{
    $page = request()->get('page', 1);
    $items = $data->slice(($page - 1) * $perPage, $perPage)->values();

    return new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $data->count(),
        $perPage,
        $page,
        ['path' => $route, 'query' => request()->query()]
    );
}

function errorMessage($err)
{
    return $err->getMessage() . ' in ' . $err->getFile() . ' on line ' . $err->getLine();
}