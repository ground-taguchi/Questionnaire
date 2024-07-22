<?php

    class CalculateData {

        public static function mergeAndCalculate( $array1, $array2 ) {

            $map = [];

            foreach ( $array2 as $item ) {

                $map[$item['shop']] = $item['count'];

            }

            foreach ( $array1 as &$item ) {

                $shopName = $item['shop_name'];

                if ( isset( $map[$shopName] ) ) {

                    $count = $map[$shopName];
                    $totalVisitors = $item['total_visitors'];
                    $item['result'] = $totalVisitors != 0 ? round( ( $count / $totalVisitors ) * 100, 2 ) : 0;

                } else {

                    $item['result'] = null;

                }

            }

            return $array1;
        }

        public static function multiplication( $array1, $array2 ) {

            $resultArray = [];
    
            foreach ( $array1 as $key => $value ) {
    
                if ( isset( $array2[$key] ) ) {
    
                    $unitPrice = $array2[$key]['unit_price'];
                    $resultArray[$key] = [];
    
                    foreach ( $value as $subKey => $subValue ) {
    
                        if ( is_numeric( $subValue ) ) {
    
                            $resultArray[$key][$subKey] = $subValue * $unitPrice;
    
                        } else {
    
                            $resultArray[$key][$subKey] = $subValue;
    
                        }
    
                    }
    
                }
    
            }
    
            return $resultArray;
        }

        public static function division( $array1, $array2 ) {

            $resultArray = [];
    
            foreach ( $array1 as $shopName => $channels1 ) {

                foreach ( $channels1 as $channelName => $value1 ) {

                    $value2 = $array2[$shopName][$channelName] ?? null;
    
                    if ( $value1 !== null && $value2 !== null && $value2 != 0 ) {

                        $resultArray[$shopName][$channelName] = round( $value1 / $value2, 2 );

                    } else {

                        $resultArray[$shopName][$channelName] = null;

                    }

                }

            }
    
            return $resultArray;
        }

    }   



