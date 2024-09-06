<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::query()
            ->where("user_id", request()->user()->id)
            ->orderBy("created_at","desc")
            ->paginate();
        return view('note.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['string', 'required']
        ]);

        $data['user_id'] = $request->user()->id;
        $note = Note::create($data);

        return to_route('note.show', $note)->with('message', 'Note was create');
    }

    /**
     * Display the specified resource.
     *
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        if ($note->user_id != request()->user()->id )
            abort(403, 'not permission'); 
        return view('note.show', ['note' => $note]);//->with('notes', $notes);
    }

    /**
     * Show the form for editing the specified resource.
     *
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        if ($note->user_id != request()->user()->id )
            abort(403, 'not permission');
        return view('note.edit', ['note' => $note]);//->with('notes', $notes);
    }

    /**
     * Update the specified resource in storage.
     *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id != request()->user()->id )
            abort(403, 'not permission');
        $data = $request->validate([
            'note' => ['string', 'required']
        ]);

        $note->update($data);

        return to_route('note.show', $note)->with('message', 'Note was updated');
    }

    /**
     * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if ($note->user_id != request()->user()->id )
            abort(403, 'not permission');
        $note->delete();
        return to_route('note.index')->with('message', 'Note was deleted');
    }
}
