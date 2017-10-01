<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class ClipboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function getJsonHash($hash) 
    {
        $hash = $this->sanitizeHash($hash);

        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if($storedValue !== false) {
                return response()->json($storedValue);
            }
            
            return response()->json(['error' => 'Invalid content']);
        }
        
        return response()->json(['error' => 'Hash not found']);
    }
    
    
    public function postHash($hash) 
    {
        $hash = $this->sanitizeHash($hash);
    
        //TODO: improve this
        $postValue = $_POST;
        
        $storeValue = serialize($postValue);
        
        Cache::put($hash, $storeValue, 1440);
        
        return response()->json($postValue);
        
        
    }
        
        
    public function getXmlHash() 
    {
        
    }
    
    
    public function getTextHash() 
    {
        
    }
    
    public function getUiHash($hash)
    {
        $hash = $this->sanitizeHash($hash);
        $storedValue = '';
        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if($storedValue !== false && isset($storedValue['input-data'])) {
                $storedValue = $storedValue['input-data'];
            } else {
                $storedValue = '';
            }
            
        }
        
        return view('ui', ['hash' => $hash, 'content' => $storedValue]);
    }
    
    
    private function sanitizeHash($hash)
    {
        $hash = strtolower($hash);
        $hash = trim(preg_replace("/[^a-z0-9\-\.]/", '', $hash));
        
        return $hash;
    }

}
