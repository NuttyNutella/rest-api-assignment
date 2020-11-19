<?php

namespace App\Http\Controllers\API;

use App\Models\CEO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function filter(Request $request, CEO $ceo)
    {
    	$ceo = $ceo->newQuery();
    	
    	if ($request->has('name'))
    	{
    		$ceo->where('name', $request->input('name'));
    	}
    	
    	if ($request->has('company_name'))
    	{
    		$ceo->where('company_name', $request->input('company_name'));
    	}
    	
    	if ($request->has('year'))
    	{
    		$ceo->where('year', $request->input('year'));
    	}
    	
    	if ($request->has('company_headquarters'))
    	{
    		$ceo->where('company_headquarters', $request->input('company_headquarters'));
    	}
    	
    	if ($request->has('industry'))
    	{
    		$ceo->where('industry', $request->input('industry'));
    	}
    	
    	return response([ $ceo->get(), 'message' => 'Results filtered'], 200);
    }
}
