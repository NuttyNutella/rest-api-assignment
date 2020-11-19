<?php

namespace App\Http\Controllers\API;

use App\Models\CEO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resource;

class FileController extends Controller
{
	public function upload()
	{
		// a simple UI for easier upload
		return view('upload');
	}
	
    public function import(Request $request, CEO $ceo)
    {   
        if ($request->hasFile('csvfile'))
        {
	        //get file
	        $upload=$request->file('csvfile');
	        $filePath=$upload->getRealPath();
	        
	        //open and read
	        $file=fopen($filePath, 'r');
	        
	        $importData_arr = array();
	        $i = 0;
	
	        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
             
                // Skip header row 
                if($i == 0){
                   $i++;
                   continue; 
                }
                for ($c=0; $c < $num; $c++) {
                	$importData_arr[$i][] = $filedata [$c];
                }
                $i++;
          	}
          	
          	fclose($file);

          	foreach($importData_arr as $importData){

            	$insertData = array(
               		"name"=>$importData[0],
               		"company_name"=>$importData[1],
               		"year"=>$importData[2],
               		"company_headquarters"=>$importData[3],
               		"industry"=>$importData[4]);
            		$ceo = CEO::create($insertData);
          	}
          	
          	return response(['message' => 'File imported successfully'], 200);
        }     
    }
    
    public function download()
	{
		$table = CEO::all();
	    $filename = "ceo.csv";
	    $handle = fopen($filename, 'w+');
	    fputcsv($handle, array('name', 'company_name', 'year', 'company_headquarters', 'industry'));
	
	    foreach($table as $row) {
	        fputcsv($handle, array($row['name'], $row['company_name'], $row['year'], $row['company_headquarters'], $row['industry']));
	    }
	
	    fclose($handle);
	
	    $headers = array(
	        'Content-Type' => 'text/csv',
	    );
	
	    return response(['message' => 'Downloading ceo.csv'], 200)->download($filename, 'ceo.csv', $headers);
	}
}
