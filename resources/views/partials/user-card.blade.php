<a href="/users/{{ $user->id }}">
    <div class="user-card">
        
        <div class="ranking"> 
            #1
        </div>
        <div class="avatar-wrapper">

            <img src="{{ $user->avatar_path }}" alt="">
        </div>
        <div>

            <h4>
        
                    {{ $user->name }}
            </h4>
            <p>54.2 km</p>
        </div>
        
    </div>
</a>