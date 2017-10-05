<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ClipboardController extends Controller
{
    
    protected $cacheTimeout = 1440;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cacheTimeout = env("CACHE_TIMEOUT", 1440);
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
    
    
    public function postHash(Request $request, $hash) 
    {
        $hash = $this->sanitizeHash($hash);
        $postValue = $request->all();
        $storeValue = serialize($postValue);
        Cache::put($hash, $storeValue, $this->cacheTimeout);
        
        return response()->json($postValue);
    }
        
        
    public function getXmlHash($hash) 
    {
        $hash = $this->sanitizeHash($hash);

        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if($storedValue !== false) {
                $content = view('xml', ['storedValue' => $storedValue]);
            } else {
                $content = view('xml', ['storedValue' => ['error' => 'Invalid content']]);
            }
        } else {
            $content = view('xml', ['storedValue' => ['error' => 'Hash not found']]);
        }
        
        return response($content, 200)->header('Content-Type', 'text/xml');
    }
    
    
    public function getRawHash($hash) 
    {
        $hash = $this->sanitizeHash($hash);

        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if($storedValue !== false) {
                $content = view('raw', ['storedValue' => $storedValue]);
            } else {
                $content = view('raw', ['storedValue' => ['error' => 'Invalid content']]);
            }
        } else {
            $content = view('raw', ['storedValue' => ['error' => 'Hash not found']]);
        }
        
        return $content;
    }
    
    public function getUiHash($hash = null)
    {
        $storedValue = '';
        if (is_null($hash)) {
            $hash = md5(uniqid());            
        } else {
            $hash = $this->sanitizeHash($hash);
            if (Cache::has($hash)) {
                $storedValue = Cache::get($hash);
                $storedValue = unserialize($storedValue);
                if($storedValue !== false && isset($storedValue['input-data'])) {
                    $storedValue = $storedValue['input-data'];
                } else {
                    $storedValue = '';
                }
            }
        }
        return view('ui', ['hash' => $hash, 'content' => $storedValue]);
    }
    
    
    private function sanitizeHash($hash)
    {
        $hash = strtolower($hash);
        $hash = trim(preg_replace("/[^a-z0-9\-\._]/", '', $hash));
        
        return $hash;
    }

}
