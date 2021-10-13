<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:list|create|edit|delete', ['only' => ['index','store']]);
        $this->middleware('permission:create', ['only' => ['create','store']]);
        $this->middleware('permission:edit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::latest()->with('status')->paginate(5);
        return view('feedback.index',compact('feedback'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'file' => 'sometimes|mimes:jpg,jpeg,png,svg,csv,txt,xlx,xls,pdf|max:2048',
        ]);
        if($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            Feedback::create([
                'title' => $request->title,
                'message' => $request->message,
                'user_id' => auth()->user()->id,
                'status_id' => 1,
                'file' => '/storage/' . $filePath
            ]);
        } else {
            Feedback::create([
                'title' => $request->title,
                'message' => $request->message,
                'user_id' => auth()->user()->id,
                'status_id' => 1
            ]);
        }

        return redirect()->route('feedback.index')
            ->with('success','Feedback created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        return view('feedback.show',compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        return view('feedback.edit',compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        if(auth()->user()->getRoleNames()[0] == 'user') {
            request()->validate([
                'name' => 'required',
                'message' => 'required',
            ]);
            $request->request->add(['status_id' => 1]);
        } else {
            request()->validate([
                'status_id' => 'required',
                'message' => 'required',
            ]);
        }
        $feedback->update($request->all());

        return redirect()->route('feedback.index')
            ->with('success','feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedback.index')
            ->with('success','feedback deleted successfully');
    }
}
