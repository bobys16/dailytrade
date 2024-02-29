<?php

use IEXBase\TronAPI\Tron;
use IEXBase\TronAPI\Support;
use kornrunner\Keccak;
use Web3\Contracts\Ethabi;
use Web3\Contracts\Types\{Address, Boolean, Bytes, DynamicBytes, Integer, Str, Uinteger};

include 'vendor/autoload.php';

$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

try {
    $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    exit($e->getMessage());
}
/*
function check_transaction_erc20($hash) {
	$wget = json_decode(file_get_contents("https://api.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=".$hash."&apikey=5XGPQQEZMYTD999FGTC1JGZM736WFTHP5Q"));
	
	
}
*/

function check_transaction_trc20($hash) {
	global $tron;
        $tx = $tron->getTransaction($hash);
        $txInfo = $tron->getTransactionInfo($hash);
        $humanTxInfo = $txInfo;
        
        if (isset($humanTxInfo['resMessage'])) 
            $humanTxInfo['resMessage'] = hex2str($humanTxInfo['resMessage']);
        
        if (isset($humanTxInfo['contract_address'])) 
            $humanTxInfo['contract_address'] = $tron->fromHex($humanTxInfo['contract_address']);
        
        if (isset($humanTxInfo['fee'])) 
            $consumedFeeLimit = bcmul($humanTxInfo['fee'], SUN_TO_TRX, 6);
            $totalFeeLimit = bcmul($tx['raw_data']['fee_limit'], SUN_TO_TRX, 6);
            
            $humanTxInfo['fee'] = "{$consumedFeeLimit} TRX / {$totalFeeLimit} TRX";
            $humanTxInfo['fee'] .= ", consumed ".bcmul(bcdiv($consumedFeeLimit,$totalFeeLimit,6), "100", 2)."% of fee limit";
        
        if (isset($humanTxInfo['receipt']['energy_fee'])) {
            $humanTxInfo['receipt']['energy_fee'] =  bcmul($humanTxInfo['receipt']['energy_fee'], SUN_TO_TRX, 6). " TRX or {$humanTxInfo['receipt']['energy_fee']} SUN";
        }
        
        if (isset($humanTxInfo['receipt']['origin_energy_usage'])) {
            $humanTxInfo['receipt']['origin_energy_usage'] .= " Energy";
        }
        
        if (isset($humanTxInfo['receipt']['energy_usage_total'])) {
            $humanTxInfo['receipt']['energy_usage_total'] .= " Energy";
        }
        
        if (isset($humanTxInfo['receipt']['energy_usage'])) {
            $humanTxInfo['receipt']['energy_usage'] .= " Energy";
        }
        
        if (isset($humanTxInfo['receipt']['net_usage'])) {
            $humanTxInfo['receipt']['net_usage'] .= " Bandwidth";
        }
        
        if (isset($humanTxInfo['receipt']['net_fee'])) {
            $humanTxInfo['receipt']['net_fee'] =  bcmul($humanTxInfo['receipt']['net_fee'], SUN_TO_TRX, 6). " TRX or {$humanTxInfo['receipt']['net_fee']} SUN";
        }
        
        $contractDetails = [];
        $ethAbi = new Ethabi(['address' => new Address,'bool' => new Boolean,'bytes' => new Bytes,'dynamicBytes' => new DynamicBytes,'int' => new Integer,'string' => new Str,'uint' => new Uinteger,]);
        
        if (is_array($humanTxInfo['log'])) {
            foreach($humanTxInfo['log'] as $k=>$log) {
                if (isset($humanTxInfo['log'][$k]['address'])) {
                    $humanTxInfo['log'][$k]['address'] = $tron->fromHex($contractAddress = "41" . $humanTxInfo['log'][$k]['address']);
                    
                    if (!$contractDetails[$contractAddress]) {
                        $contractDetail = $tron->getManager()->request("wallet/getcontract", ["value"=>$contractAddress], "post");
                        $contractDetails[$contractAddress] = $contractDetail;
                    }
                    
                    //decode
                    $topicPointer = 0;
                    $targetFunction = $humanTxInfo['log'][$k]['topics'][ $topicPointer++ ];
                    $abiItems = $contractDetails[$contractAddress]['abi']['entrys'];
                    
                    foreach($abiItems as $item) {
                        if ($item['type'] == 'Event') {
                            $functionParams = [];
                            if (@count($item['inputs']) > 0)  {
                                foreach($item['inputs'] as $input) {
                                    $functionParams[] = $input['type'];
                                }
                            }
                            
                            $compareFunction = Keccak::hash($plain = "{$item['name']}(".implode(",",$functionParams).")",256);
                            
                            if ($compareFunction == $targetFunction) {
                                $humanTxInfo['log'][$k]['topics'][0] = $plain;
                                $functionNames = $functionParams = [];
                                
                                if (@count($item['inputs']) > 0)  {
                                    foreach($item['inputs'] as $input) {
                                        
                                        if($input['indexed'] === true) {
                                            $thisTopic = $topicPointer++;
                                            $paramValue = $humanTxInfo['log'][$k]['topics'][ $thisTopic ];
                                            $decodedValue = $ethAbi->decodeParameter($input['type'], $paramValue);
                                            if ($input['type'] == 'address') {
                                                $humanTxInfo['log'][$k]['topics'][ $thisTopic ] = $tron->fromHex("41".substr($decodedValue, 2));
                                            }
                                        } else {
                                            $functionParams[] = $input['type'];
                                            $functionNames[] = $input['name'];
                                        }
                                    }
                                }
                                
                                $nonIndexedData = $humanTxInfo['log'][$k]['data'];
                                if (count($functionParams) > 0 AND strlen($nonIndexedData) > 0) {
                                    $decodedValues = $ethAbi->decodeParameters($functionParams, $nonIndexedData);
                                    
                                    if (@count($decodedValues) > 0) {
                                        $humanTxInfo['log'][$k]['decodedData'] = [];
                                        foreach($decodedValues as $k2=>$decodedValue) {
                                            
                                            if (is_bool($decodedValue)) {
                                                $decodedValue = ($decodedValue === true) ? "true" : "false";
                                            }
                                            
                                            $humanTxInfo['log'][$k]['decodedData'][] = "{$decodedValue}";
                                            
                                        }
                                    }
                                }
                            } 
                        }
                    }
                }
            }
        }
		$result = array();
		$result['result'] = $humanTxInfo['receipt']['result'];
		$result['from'] = $humanTxInfo['log'][0]['topics'][1];
		$result['to'] = $humanTxInfo['log'][0]['topics'][2];
		$result['value'] = ($humanTxInfo['log'][0]['decodedData'][0] / 1000000);
		
	return $result;
}