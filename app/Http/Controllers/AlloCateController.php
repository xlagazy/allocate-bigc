<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Model\ALCBigcArticle;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\AllocateSheetExport;

use Cookie;
use DB;

class AlloCateController extends Controller
{

    function upload()
    {
        return view('upload');
    }

    function import(Request $request)
    {
        //upload file from input tag.
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        
        //variable find head column.
        $headCol = ['Report Code', 'Supplier', 'Business Format', 'Store', 'Barcode', 'Article', 'Article Name', 'Stock Qty TY', 'Day on Hand TY(Day)'];
        //variable check correct or incorrect head column.
        $chkHead = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        //vaiable store index csv head column.
        $csvHead = [];

        //get data condition from database.
        $condition = DB::table('ALCBigcCond')
                            ->orderBy('barcode', 'ASC')
                            ->orderBy('condition', 'ASC')
                            ->get();

        //get csv data to variable fill.
        foreach ($fileContents as $line) 
        {
            $fill[] = str_getcsv($line);
        }

        //check head column and store index to csv file.
        foreach($headCol as $key => $head)
        {
            for($i=0;$i<count($fill[0]);$i++)
            {

                    if($fill[0][$i] == $head)
                    {
                        $chkHead[$key] = 1;
                        $csvHead[$key] = $i;
                        break;
                    }       
            }
        }

        if(array_search(0, $chkHead))
        {
            //error file 
            
            return redirect()->back()->with('error', 'Data added successfully');;
        }
        else
        {
            //complete file 

            //store data from csv to variable data for convert to xlsx.
            for($i=0;$i<count($fill);$i++){
                if($i != 0){
                    if($fill[$i][$csvHead[7]] <= 21){

                        $article = DB::table('ALCBigcArticleDetail')
                                        ->select('price',
                                                 'promotion',
                                                 'price_promo')
                                        ->where('article_no', $fill[$i][$csvHead[5]])
                                        ->where('status', 1)
                                        ->get();

                        if(count($article) != 0)
                        {

                            $sumStock = 0;
                            $total = 0;
                            $price = 0;

                            //check price promotion or default price
                            if($article[0]->promotion == 1)
                            {
                                $price += $article[0]->price_promo;
                            }
                            else{
                                $price += $article[0]->price;
                            }

                            //check and cal sumstock
                            foreach($condition as $dataCond)
                            {
                                if($dataCond->barcode == $fill[$i][$csvHead[4]]){
                                    if($dataCond->math == 0)
                                    {
                                        if($fill[$i][$csvHead[7]] <= $dataCond->condition){
                                            $sumStock = $dataCond->volume;
                                            $total = $sumStock * $price;
                                            break;
                                        }
                                    }
                                    else if($dataCond->math == 1)
                                    {
                                        if($fill[$i][$csvHead[7]] >= $dataCond->condition){
                                            $sumStock = $dataCond->volume;
                                            $total = $sumStock * $price;
                                            break;
                                        }
                                    }
                                    else if($dataCond->math == 2)
                                    {
                                        if($fill[$i][$csvHead[7]] == $dataCond->condition){
                                            $sumStock = $data->volume;
                                            $total = $sumStock * $price;
                                            break;
                                        }
                                    }
                                }
                                else{
                                    $sumStock = "ไม่พบข้อมูล";
                                    $total = "ไม่พบข้อมูล";
                                }
                            }

                            //get all data to array
                            $data[] = array(
                                'report_code' => $fill[$i][$csvHead[0]],
                                'supplier' => iconv( 'TIS-620', 'UTF-8', $fill[$i][$csvHead[1]]),
                                'bussiness_format' => $fill[$i][$csvHead[2]],
                                'store' => $fill[$i][$csvHead[3]],
                                'barcode' => $fill[$i][$csvHead[4]],
                                'article' => $fill[$i][$csvHead[5]],
                                'article_name' => iconv( 'TIS-620', 'UTF-8', $fill[$i][$csvHead[6]]),
                                'stock' => $fill[$i][$csvHead[7]],
                                'sumstock' => $sumStock,
                                'price' => $price,
                                'total' => $total
                            );

                            //insert or update article
                            $this->putArticle($fill[$i][$csvHead[5]], $fill[$i][$csvHead[4]], iconv( 'TIS-620', 'UTF-8', $fill[$i][$csvHead[6]]));
                        }
                    }
                }
            }

            $fileName = 'AllocateBigC'.Cookie::get('code');
            
            session()->put('fileName', $fileName);

            Excel::store(new AllocateSheetExport($data), '/files//'.$fileName.'.xlsx');

            return redirect()->back()->with('success', 'Data added successfully');
            
        }
    }

    function download($fileName)
    {
        $filePath = storage_path('/app/files/'.$fileName.'.xlsx');

        return Response::download($filePath);
    }

    public static function putArticle($article_no, $barcode, $article_name)
    {
        $article = DB::table('ALCBigcArticle')
                        ->where('article_no', '=', $article_no)
                        ->get();

        if(count($article) != 0)
        {
            //update article
            DB::table('ALCBigcArticle')
                    ->where('article_no', '=', $article_no)
                    ->update([
                        'article_no' => $article_no,
                        'barcode' => $barcode,
                        'article_name' => $article_name
                    ]);
        }
        else
        {
            //insert article
            DB::table('ALCBigcArticle')
                    ->insert([
                        'article_no' => $article_no,
                        'barcode' => $barcode,
                        'article_name' => $article_name
                    ]);
        }
    }

}
