<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClipboardController extends Controller
{

    protected int $cacheTimeout = 1440;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cacheTimeout = env("CACHE_TIMEOUT", 1440);
    }

    public function index(Request $request): View
    {
        return view('index',
            [
                'host' => $request->getSchemeAndHttpHost(),
                'cachetimeout' => $this->cacheTimeout
            ]
        );
    }

    public function getJsonHash($hash)
    {
        $hash = $this->sanitizeHash($hash);

        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if ($storedValue !== false) {
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

        $cleanData = [];
        foreach ($postValue as $key => $value) {
            $cleanData[$this->sanitizeKey($key)] = $this->sanitizeContent($value);
        }

        $storeValue = serialize($cleanData);
        Cache::put($hash, $storeValue, $this->cacheTimeout);

        return response()->json($cleanData);
    }


    public function getXmlHash($hash)
    {
        $hash = $this->sanitizeHash($hash);

        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if ($storedValue !== false) {

                $data = [];
                foreach ($storedValue as $key => $value) {
                    $data[] = ['startTag' => '<' . $key . '>', 'endTag' => '</' . $key . '>', 'content' => $value];
                }
                $content = view('xml', ['data' => $data]);
                return response($content, 200)->header('Content-Type', 'text/xml');
            }

            $content = view('xml', ['storedValue' => ['error' => 'Invalid content']]);
            return response($content, 200)->header('Content-Type', 'text/xml');
        }

        $content = view('xml', ['storedValue' => ['error' => 'Hash not found']]);
        return response($content, 200)->header('Content-Type', 'text/xml');
    }


    public function getRawHash($hash): View
    {
        $hash = $this->sanitizeHash($hash);

        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedValue = unserialize($storedValue);
            if ($storedValue !== false) {
                return view('raw', ['storedValue' => $storedValue]);
            }

            return view('raw', ['storedValue' => ['error' => 'Invalid content']]);
        }

        return view('raw', ['storedValue' => ['error' => 'Hash not found']]);
    }

    public function getUiHash($hash = null): View
    {
        $storedArray = ['data' => ''];

        $hash = $hash === null ? md5(uniqid()) : $this->sanitizeHash($hash);
        if (Cache::has($hash)) {
            $storedValue = Cache::get($hash);
            $storedArray = unserialize($storedValue);
            if ($storedArray === false || !is_array($storedArray)) {
                $storedArray = ['data' => ''];
            }
        }

        return view('ui', ['hash' => $hash, 'storedArray' => $storedArray]);
    }

    private function sanitizeHash(string $hash): string
    {
        $hash = strtolower($hash);
        $hash = trim(preg_replace("/[^a-z0-9:\-\._]/", '', $hash));

        return $hash;
    }

    private function sanitizeKey(string $key): string
    {
        return trim(preg_replace("/[^a-zA-Z0-9]/", '', strtolower($key)));
    }

    private function sanitizeContent(string $content): string
    {
        return htmlentities($content);
    }

}
