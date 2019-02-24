<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics;

class TopicsController extends Controller
{
    public function __construct() {
        $this->topics = new Topics();
    }

    public function listAction()
    {
        $topics = $this->topics->all()->toArray();

        return view('topics.list', ['topics' => $topics]);
    }

    public function addAction(Request $request)
    {

        if ($request->method() == "POST") {
            $key = $request->input('key');
            $name = $request->input('name');
            $file = $request->file('image');
            $folder = storage_path('images/topics');
            $imageLink = $file->move($folder, $file->getClientOriginalName());

            $result = $this->topics->insert([
                'key' => $key,
                'name' => $name,
                'image_link' => $imageLink,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
            if ($result) {
                return redirect('topics/list');
            }
        }
        return view('topics.add');
    }

    public function editAction(Request $request)
    {
        $id = $request->query('id');
        $topic = $this->topics->where('id', '=', $id)->first()->toArray();
        if ($request->method() == "POST") {
            $key = $request->input('key');
            $name = $request->input('name');
            $file = $request->file('image');
            $folder = storage_path('images/topics');
            if (!empty($file)) {
                $imageLink = $file->move($folder, $file->getClientOriginalName());
            }

            $updatedData = [];
            if (!empty($key)) $updatedData['key'] = $key;
            if (!empty($name)) $updatedData['name'] = $name;
            if (!empty($imageLink)) $updatedData['image_link'] = $imageLink;
            if (!empty($updatedData)) $updatedData['updated_at'] = new \DateTime();

            if (!empty($updatedData)) {
                $result = $this->topics->where('id', $id)->update($updatedData);
            }

            if ($result) {
                return redirect('topics/list');
            }
        }

        return view('topics.edit', ['topic' => $topic]);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->query('id');
        $result = $this->topics->where('id', $id)->delete();

        if ($result) {
            return redirect('topics/list');
        }
    }
}
