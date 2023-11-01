<div class="dropdown mx-1">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Добавить в плейлист
    </button>
    <ul class="dropdown-menu">
        @forelse($playlists as $playlist)
            <li><a class="dropdown-item" href="{{ route('playlist.record.update', [$playlist, $record]) }}">{{ $playlist->name }}</a></li>
        @empty
            <li>Плейлисты не созданы</li>
        @endforelse
    </ul>
</div>