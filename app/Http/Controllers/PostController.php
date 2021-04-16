<?php

namespace App\Http\Controllers;

use App\Exports\PostExport;
use App\Imports\PostImport;
use App\Model\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends AdminController
{
    const PATH = 'assets/uploads';

    /**
     * List post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list() {
        $listPost = Post::all();
        return view('post.list', compact('listPost'));
    }

    /**
     * Add screen
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add() {
        return view('post.add');
    }

    /**
     * Create new post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request) {
        if ($request->isMethod('post')) {
            $data = [
                'title'      => $request->input('title'),
                'content'    => $request->input('content'),
            ];
            if ($request->hasFile('image')) {
                $result = $this->uploadImage($request->file('image'));
                if (!$result) {
                    return redirect(route('home'));
                }
                $data['image'] = $result;
            }
            $post = new Post();
            if ($post->create($data)) {
                return redirect(route('home'));
            }
        }
    }

    /**
     * Update post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request) {
        if ($request->isMethod('post')) {
            $data = [
                'title'      => $request->input('title'),
                'content'    => $request->input('content'),
            ];
            if ($request->hasFile('image')) {
                $result = $this->uploadImage($request->file('image'));
                if (!$result) {
                    return redirect(route('home'));
                }
                $data['image'] = $result;
            }
            $post = new Post();
            if ($post->edit($data, $request->input('id'))) {
                return redirect(route('home'));
            }
        }
    }

    /**
     * Delete post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request) {
        if ($request->isMethod('post')) {
            $id = $request->input('id');
            $post = new Post();
            $rs = [];
            $rs['result'] = false;
            if ($post->logicDelete($id)) {
                $rs['result'] = true;
                $post = Post::find($id);
                $data = [
                    'receiver' => Auth::user()['name'],
                    'subject' => 'Post notification',
                    'email' => Auth::user()['email'],
                    'name' => $post['title'],
                ];
                $this->sendMail($data);
            }
            return response()->json($rs);
        }
    }

    /**
     * Export all post
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportAll() {
        return Excel::download(new PostExport, 'file.csv');
    }

    /**
     * Import
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function import(Request $request) {
        if ($request->hasFile('import-file')) {
            Excel::import(new PostImport, $request->file('import-file'));
        }
        return redirect(route('home'));
    }

    /**
     * Upload file
     * @param $file
     * @return bool|string
     */
    private function uploadImage($file) {
        $fileName = Carbon::now()->timestamp.$file->getClientOriginalName();
        if ($file->move(self::PATH, $fileName)) {
            return self::PATH.'/'.$fileName;
        }
        return false;
    }

    private function sendMail($data) {
        Mail::send('email.deletepost', $data, function($message) use ($data) {
            $message->to($data['email'], $data['receiver'])
                ->subject($data['subject']);
        });
    }
}
