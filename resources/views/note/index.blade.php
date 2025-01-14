<x-app-layout>
    <div class="note-container py-12">
        <a href="{{route('note.create') }}" class="new-note-btn">
            New Note
        </a>
        <div class="notes">
            {{-- @if (count($notes) > 0) --}}
                @foreach ($notes as $note)
                    <div class="note">
                        <div class="note-body">
                            {{Str::words($note->note, 30)}}
                        </div>
                        <div class="note-buttons">
                            <a href="{{route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                            <a href="{{route('note.show', $note) }}" class="note-edit-button">View</a>
                            <form action="{{ route('note.destroy', $note) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="note-delete-button">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            {{-- @endif --}}
        </div>
        <div class="p-6">
            {{ $notes->links() }}
        </div>
       
    </div>
</x-app-layout>