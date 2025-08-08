<renderer class="modals-renderer">
    @if (isset($modals))
        {{-- Add default modals --}}
        @include('includes.modals.level-up')
        @foreach ($modals as $modalPath)
            @php
                $modalName = basename($modalPath, '.blade.php');
            @endphp
            @include('includes.modals.' . $modalName)
        @endforeach
    @else
        @foreach (glob(resource_path('views/includes/modals/*.blade.php')) as $modalPath)
            @php
                $modalName = basename($modalPath, '.blade.php');
            @endphp
            @include('includes.modals.' . $modalName)
        @endforeach
    @endif
</renderer>