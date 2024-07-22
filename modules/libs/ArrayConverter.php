<?php

    class ArrayConverter {

        protected static function transform( $arrayData, $callback ) {

            $transformedData = [];

            foreach ( $arrayData as $item ) {

                $shopName = $item['shop_name'];
                unset( $item['shop_name'] );
                $callback( $transformedData, $shopName, $item );

            }

            return $transformedData;

        }

        public static function xAdExpenses( $arrayData ) {

            return self::transform( $arrayData, function( &$transformedData, $shopName, $item ) {

                $channelName = $item['channel_shortname'];
                $cost = $item['cost'];

                if ( !isset( $transformedData[$shopName] ) ) {

                    $transformedData[$shopName] = [];

                }

                $transformedData[$shopName][$channelName] = $cost;

            });

        }

        public static function xStoreSales( $arrayData ) {

            return self::transform( $arrayData, function( &$transformedData, $shopName, $item ) {

                $transformedData[$shopName] = $item;

            });

        }

        public static function overwriteArray( &$arrayData1, $arrayData2 ) {

            foreach ( $arrayData2 as $key1 => $value1 ) {

                if ( isset( $arrayData1[$key1] ) ) {

                    foreach ( $value1 as $key2 => $value2 ) {

                        if ( isset( $arrayData1[$key1][$key2] ) ) {

                            $arrayData1[$key1][$key2] = $value2;

                        }

                    }
                }

            }

        }

        public static function replaceKeys( $arrayData, $replaceArray ) {

            // 置換データ
            $replaceMap = [
                'シティヘブン' => $replaceArray[0],
                '口コミ風俗情報局' => $replaceArray[1],
                '川崎ソープ徹底攻略' => $replaceArray[4],
                '駅ちか人気風俗ランキング' => $replaceArray[5],
                'オフィシャルHP' => $replaceArray[6]
            ];
    
            // 短縮名に置換
            foreach ( $arrayData as $shop => $sources ) {

                foreach ( $sources as $key => $value ) {

                    if ( array_key_exists( $key, $replaceMap ) ) {

                        $newKey = $replaceMap[$key];
                        $arrayData[$shop][$newKey] = $value;
                        unset( $arrayData[$shop][$key] );

                    }

                }

            }
    
            return $arrayData;
        }

        public static function sortKeys( $arrayData, $orderArray ) {

            // channel_order順に並び替え
            foreach ( $arrayData as $shop => $sources ) {

                $sortedArray = [];

                foreach ( $orderArray as $key ) {

                    if ( array_key_exists( $key, $sources ) ) {

                        $sortedArray[$key] = $sources[$key];

                    }

                }

                $arrayData[$shop] = $sortedArray;

            }
    
            return $arrayData;
        }        

    }