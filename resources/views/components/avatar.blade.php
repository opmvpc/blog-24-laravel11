<div {{ $attributes->merge(['class' => 'rounded-full overflow-hidden']) }}>
    @if ($user->avatar_path)
        <img class="w-full aspect-square object-cover object-center" src="{{ asset('storage/' . $user->avatar_path) }}"
            alt="{{ $user->name }}" />
    @else
        <div class="w-full h-full aspect-square flex items-center justify-center bg-indigo-100">
            <span class="text-2xl font-medium text-indigo-800">
                {{ $user->name[0] }}
            </span>
        </div>
    @endif
</div>
