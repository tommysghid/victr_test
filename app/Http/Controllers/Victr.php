<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Storage;

use DB;

class Victr extends BaseController
{
    public function index(){
        
        try{
          $response = Http::get('https://api.github.com/search/repositories?q=language:php&sort=stars&order=desc');
    	
    	  $data = $response->json();
        
          if($response->successful()){
              
            $this->delete();
           
            $restrict=0;
            foreach($data['items'] as $repos){
              if($restrict<10){
                $this->store($repos);
              }
              $restrict++;
            }
            
          }
          
          //if there is an error storing the data 
          //at least return "old" data
          $reposToShow = $this->retrieve();
                    
          return $reposToShow;
          
        }catch(Exception $e){
            
            $msg = "There was an error trying to get github data.";
            
            Log::error($msg);
            Log::error($e);
            
            return view::error($msg);
            
        }
    	
    }
    
    private function store($repoData){
        
        try{
        
            //laravel will escape as this is not a raw sql query
            //no need to parameterize or manual escape
            DB::table('victr')->insertGetId(
                  [
                     'repo_id'=>$repoData['id'],
                     'name'=>$repoData['name'],
                     'repo_url'=>$repoData['html_url'],
                     'created_date'=> \Carbon\Carbon::parse($repoData['created_at'])->format("Y-m-d H:i:s"),
                     'last_push_date'=> \Carbon\Carbon::parse($repoData['updated_at'])->format("Y-m-d H:i:s"),
                     'description'=> (!(is_null($repoData['description'])) ? $repoData['description'] : ''),
                     'num_of_stars'=>$repoData['stargazers_count'],
                     'created_at'=> \Carbon\Carbon::parse($repoData['created_at'])->format("Y-m-d H:i:s"),
                   ]
            );
        
        }catch(Exception $e){
        
            $msg = "There was a problem retrieving your data. Please contact IT.";
            
            Log::error($msg);
            Log::error($e);
            
            throw Exception;
        }
        
        return TRUE;
    }
        
    private function retrieve(){
        
         try{
        
          $data = DB::table('victr')->get();
          
          return $data;
                    
         }catch(Exception $e){
            $msg = "There was a problem retrieving your data. Please contact IT.";
            
            Log::error($msg);
            Log::error($e);
            
            throw Exception;
         }
       
    }
    
    private function delete(){
        
      try{
        
        DB::table('victr')->truncate();
        
        return TRUE;
        
      }catch(Exception $e){
            $msg = "There was a problem retrieving your data. Please contact IT.";
            
            Log::error($msg);
            Log::error($e);
            
            throw Exception;
       }
    }
}

