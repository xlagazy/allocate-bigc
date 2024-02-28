<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ArticleController extends Controller
{
    function article()
    {
        isset($_GET['sArticle']) != '' ? $sArticle = $_GET['sArticle'] : $sArticle = "";
        isset($_GET['sArticleName']) != '' ? $sArticleName = $_GET['sArticleName'] : $sArticleName = "";
        isset($_GET['sBarcode']) != '' ? $sBarcode = $_GET['sBarcode'] : $sBarcode = "";
        isset($_GET['sPrice']) != '' ? $sPrice = $_GET['sPrice'] : $sPrice = "";
        isset($_GET['sPricePromo']) != '' ? $sPricePromo = $_GET['sPricePromo'] : $sPricePromo = "";
        isset($_GET['sPack']) != '' ? $sPack = $_GET['sPack'] : $sPack = "";
        isset($_GET['sSize']) != '' ? $sSize = $_GET['sSize'] : $sSize = "";
        isset($_GET['sStatus']) != '' ? $sStatus = $_GET['sStatus'] : $sStatus = "";

        $article = DB::table('ALCBigcArticleDetail as ad')
                        ->select('ad.*',
                                 'ac.article_name')
                                 ->leftjoin('ALCBigcArticle as ac', 'ad.article_no', '=', 'ac.article_no')
                                 ->get();

        return view('article', ['article' => $article, 'sArticle' => $sArticle, 'sArticleName' => $sArticleName, 'sBarcode' => $sBarcode,
                                'sPrice' => $sPrice, 'sPricePromo' => $sPricePromo, 'sPack' => $sPack, 'sSize' => $sSize, 'sStatus' => $sStatus]);
    }

    function searchArticle()
    {
        isset($_GET['sArticle']) != '' ? $sArticle = $_GET['sArticle'] : $sArticle = "";
        isset($_GET['sArticleName']) != '' ? $sArticleName = $_GET['sArticleName'] : $sArticleName = "";
        isset($_GET['sBarcode']) != '' ? $sBarcode = $_GET['sBarcode'] : $sBarcode = "";
        isset($_GET['sPrice']) != '' ? $sPrice = $_GET['sPrice'] : $sPrice = "";
        isset($_GET['sPricePromo']) != '' ? $sPricePromo = $_GET['sPricePromo'] : $sPricePromo = "";
        isset($_GET['sPack']) != '' ? $sPack = $_GET['sPack'] : $sPack = "";
        isset($_GET['sSize']) != '' ? $sSize = $_GET['sSize'] : $sSize = "";
        isset($_GET['sStatus']) != '' ? $sStatus = $_GET['sStatus'] : $sStatus = "";

        if(!empty($sArticleName))
        {
            $article = DB::table('ALCBigcArticleDetail as ad')
                            ->select('ad.*',
                                    'ac.article_name')
                            ->leftjoin('ALCBigcArticle as ac', 'ad.article_no', '=', 'ac.article_no')
                            ->where('ad.article_no', 'LIKE', '%'.$sArticle.'%')
                            ->where('ac.article_name', 'LIKE', '%'.$sArticleName.'%')
                            ->where('ad.barcode', 'LIKE', '%'.$sBarcode.'%')
                            ->where('ad.price', 'LIKE', '%'.$sPrice.'%')
                            ->where('ad.price_promo', 'LIKE', '%'.$sPricePromo.'%')
                            ->where('ad.pack', 'LIKE', '%'.$sPack.'%')
                            ->where('ad.size', 'LIKE', '%'.$sSize.'%')
                            ->where('ad.status', 'LIKE', '%'.$sStatus.'%')
                            ->get();
        }
        else
        {
            $article = DB::table('ALCBigcArticleDetail as ad')
                            ->select('ad.*',
                                    'ac.article_name')
                            ->leftjoin('ALCBigcArticle as ac', 'ad.article_no', '=', 'ac.article_no')
                            ->where('ad.article_no', 'LIKE', '%'.$sArticle.'%')
                            ->where('ad.barcode', 'LIKE', '%'.$sBarcode.'%')
                            ->where('ad.price', 'LIKE', '%'.$sPrice.'%')
                            ->where('ad.price_promo', 'LIKE', '%'.$sPricePromo.'%')
                            ->where('ad.pack', 'LIKE', '%'.$sPack.'%')
                            ->where('ad.size', 'LIKE', '%'.$sSize.'%')
                            ->where('ad.status', 'LIKE', '%'.$sStatus.'%')
                            ->get();
        }

        return view('article', ['article' => $article, 'sArticle' => $sArticle, 'sArticleName' => $sArticleName, 'sBarcode' => $sBarcode,
                                'sPrice' => $sPrice, 'sPricePromo' => $sPricePromo, 'sPack' => $sPack, 'sSize' => $sSize, 'sStatus' => $sStatus]);
    }

    function update(Request $request)
    {
        $no = $request->input('no');
        $article_no = $request->input('article_no');
        $barcode = $request->input('barcode');
        $price = $request->input('price');
        $promotion = $request->input('promotion');
        $price_promo = $request->input('price_promo');
        $pack = $request->input('pack');
        $size = $request->input('size');
        $status = $request->input('status');
        $rmvNo = $request->input('rmvNo');

        //delete data
        if(isset($rmvNo))
        {
            for($i=0;$i < count($rmvNo);$i++)
            {
                DB::table('ALCBigcArticleDetail')
                    ->where('no', $rmvNo[$i])
                    ->delete();
            }
        }


        if(!empty($article_no))
        {
            for($i=0;$i < count($article_no);$i++)
            {
                if($no[$i] != "")
                {
                    $dataUpdate = array(
                        'article_no' => $article_no[$i],
                        'barcode' => $barcode[$i],
                        'price' => $price[$i],
                        'promotion' => $promotion[$i],
                        'price_promo' => $price_promo[$i],
                        'pack' => $pack[$i],
                        'size' => $size[$i],
                        'status' => $status[$i],
                        'update_time' => now()
                    );
    
                    //update data
                    DB::table('ALCBigcArticleDetail')
                        ->where('no', $no[$i])
                        ->update($dataUpdate);
                }
                else
                {
                    $dataInsert = array(
                        'article_no' => $article_no[$i],
                        'barcode' => $barcode[$i],
                        'price' => $price[$i],
                        'promotion' => $promotion[$i],
                        'price_promo' => $price_promo[$i],
                        'pack' => $pack[$i],
                        'size' => $size[$i],
                        'status' => $status[$i],
                        'update_time' => now(),
                        'create_time' => now()
                    );
    
                    //insert data
                    DB::table('ALCBigcArticleDetail')
                        ->insert($dataInsert);
                }
            }
        }
    
        return redirect()->back();
    }
}
