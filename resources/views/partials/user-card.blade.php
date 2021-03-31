<a href="/users/{{ $user->id }}">
    <div class="user-card">
        
        <div class="ranking"> 
            #{{ ++$index }}
        </div>
        <div class="avatar-wrapper">

            <img src="{{ $user->avatar_path }}" alt="">
        </div>
        <div>

            <h4>
        
                    {{ $user->name }}
            </h4>
            <div class="user-stats">
                <p>{{ $user->walkedDistance() }}km</p>
                |
                <p>{{ $user->timeOnHills() }}s</p>
            </div>
        </div>
        
    </div>
</a>