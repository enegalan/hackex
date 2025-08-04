<renderer class="modals-renderer">
    @foreach (glob(resource_path('views/includes/modals/*.blade.php')) as $modalPath)
        @php
            $modalName = basename($modalPath, '.blade.php');
        @endphp
        @include('includes.modals.' . $modalName)
    @endforeach
</renderer>