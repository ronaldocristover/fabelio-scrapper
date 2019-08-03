<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Goutte;
class CommentController extends Controller
{
    public function create()
    {
        $data = app('db')->table('comments')->insert([
            'link_id' => request()->get('link_id', ''),
            'comment' => request()->get('comment', ''),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back();
    }

    public function vote($id, $type = '0')
    {
        app('db')->table('votes')->insert([
            'comment_id' => $id, 
            'like' => $type, 
            'user' => request()->ip(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back();
    }

    public function totalVotes($commentId, $type)
    {
        $data = app('db')->table('votes')->where('comment_id', $commentId)->where('like', $type)->count();
        return $data;
    }
}