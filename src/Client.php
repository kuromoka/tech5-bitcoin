<?php
namespace Tech5Bitcoin;

/**
 * Client Class
 */
class Client
{
    public function test()
    {
        echo "tech5-bitcoin\n";
    }

    public function getBtcPrice() {
        // Guzzleのインスタンスを作成
        $client = new \GuzzleHttp\Client();

        // https://api.bitflyer.com/v1/getticker?product_code=BTC_JPY のGETリクエストでTickerを呼び出す
        $response = $client->request('GET', 'https://api.bitflyer.com/v1/getticker', [
            'query' => ['product_code' => 'BTC_JPY']
        ]);

        // $response->getBody()->getContents()で、APIからのレスポンスを取得できる
        // 結果はJSONで返却されるのでデコード
        $result = json_decode($response->getBody()->getContents(), true);

        // ltpキーにBitcoinに対する日本円の最終取引価格が入る
        if ($result['ltp']) {
            return $result['ltp'];
        } else {
            return null;
        }
    }
}
