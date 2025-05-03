<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        return response()->json($page);
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        $page->content = $request->content;
        $page->save();

        return response()->json(['message' => 'Page updated successfully']);
    }
}
