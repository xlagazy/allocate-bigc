<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ConditionController extends Controller
{
    function condition()
    {
        isset($_GET['sBarcode']) != '' ? $sBarcode = $_GET['sBarcode'] : $sBarcode = "";
        isset($_GET['sAriticleName']) != '' ? $sAriticleName = $_GET['sAriticleName'] : $sAriticleName = "";
        isset($_GET['sMath']) != '' ? $sMath = $_GET['sMath'] : $sMath = "";
        isset($_GET['sCondition']) != '' ? $sCondition = $_GET['sCondition'] : $sCondition = "";
        isset($_GET['sVolume']) != '' ? $sVolume = $_GET['sVolume'] : $sVolume = "";

        $cond= DB::table('ALCBigcCond as ab')
                        ->select('ab.*',
                                 'ac.article_name')
                        ->leftjoin('ALCBigcArticle as ac', 'ab.barcode', '=', 'ac.barcode')
                        ->orderBy('ab.barcode', 'ASC')
                        ->orderBy('ab.condition', 'ASC')
                        ->get();

        return view('condition', ['cond' => $cond, 'sBarcode' => $sBarcode, 'sMath' => $sMath, 
                                  'sCondition' => $sCondition, 'sVolume' => $sVolume, 'sAriticleName' => $sAriticleName]);
    }

    function searchCondition()
    {
        isset($_GET['sBarcode']) != '' ? $sBarcode = $_GET['sBarcode'] : $sBarcode = "";
        isset($_GET['sAriticleName']) != '' ? $sAriticleName = $_GET['sAriticleName'] : $sAriticleName = "";
        isset($_GET['sMath']) != '' ? $sMath = $_GET['sMath'] : $sMath = "";
        isset($_GET['sCondition']) != '' ? $sCondition = $_GET['sCondition'] : $sCondition = "";
        isset($_GET['sVolume']) != '' ? $sVolume = $_GET['sVolume'] : $sVolume = "";

        if(!empty($sAriticleName))
        {
            $cond= DB::table('ALCBigcCond as ab')
                        ->select('ab.*',
                                'ac.article_name')
                        ->leftjoin('ALCBigcArticle as ac', 'ab.barcode', '=', 'ac.barcode')
                        ->where('ab.barcode', 'LIKE', '%'.$sBarcode.'%')
                        ->where('ac.article_name', 'LIKE', '%'.$sAriticleName.'%')
                        ->where('ab.math', 'LIKE', '%'.$sMath.'%')
                        ->where('ab.condition', 'LIKE', '%'.$sCondition.'%')
                        ->where('ab.volume', 'LIKE', '%'.$sVolume.'%')
                        ->orderBy('barcode', 'ASC')
                        ->orderBy('condition', 'ASC')
                        ->get();
        }
        else
        {
            $cond= DB::table('ALCBigcCond as ab')
                        ->select('ab.*',
                                'ac.article_name')
                        ->leftjoin('ALCBigcArticle as ac', 'ab.barcode', '=', 'ac.barcode')
                        ->where('ab.barcode', 'LIKE', '%'.$sBarcode.'%')
                        ->where('ab.math', 'LIKE', '%'.$sMath.'%')
                        ->where('ab.condition', 'LIKE', '%'.$sCondition.'%')
                        ->where('ab.volume', 'LIKE', '%'.$sVolume.'%')
                        ->orderBy('barcode', 'ASC')
                        ->orderBy('condition', 'ASC')
                        ->get();
        }
        

        return view('condition', ['cond' => $cond, 'sBarcode' => $sBarcode, 'sMath' => $sMath, 
                                  'sCondition' => $sCondition, 'sVolume' => $sVolume, 'sAriticleName' => $sAriticleName]);
    }

    function update(Request $request)
    {
        $no = $request->input('no');
        $barcode = $request->input('barcode');
        $math = $request->input('math');
        $condition = $request->input('condition');
        $volume = $request->input('volume');
        $rmvNo = $request->input('rmvNo');

        //delete data
        if(isset($rmvNo))
        {
            for($i=0;$i < count($rmvNo); $i++)
            {
                DB::table('ALCBigcCond')
                    ->where('no', $rmvNo[$i])
                    ->delete();
            }
        }
        
        if(!empty($barcode))
        {
            for($i=0;$i < count($barcode);$i++)
            {
                if($no[$i] != "")
                {
                    $dataUpdate = array(
                        'barcode' => $barcode[$i],
                        'math' => $math[$i],
                        'condition' => $condition[$i],
                        'volume' => $volume[$i],
                        'update_time' => now()
                    );
    
                    //update data
                    DB::table('ALCBigcCond')
                        ->where('no', $no[$i])
                        ->update($dataUpdate);
    
                }
                else
                {
                    $dataInsert = array(
                        'barcode' => $barcode[$i],
                        'math' => $math[$i],
                        'condition' => $condition[$i],
                        'volume' => $volume[$i],
                        'create_time' => now(),
                        'update_time' => now()
                    );
    
                    //insert data
                    DB::table('ALCBigcCond')
                        ->insert($dataInsert);
                }
            }
        }
        
        return redirect()->back();
    }
}
