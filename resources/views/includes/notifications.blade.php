@php
    $types = ['success' => '#22C55E', 'error' => '#EF4444', 'warning' => '#F59E0B', 'info' => '#0EA5E9', 'message' => '#3B82F6'];
    $toast = null;
    foreach ($types as $error_type => $color) {
        if (session($error_type) || isset($$error_type)) {
            $message = session($error_type) ?: $$error_type;
            $toast = [
                'message' => $message,
                'color' => $color,
                'type' => $error_type,
            ];
            break;
        }
    }
@endphp
@if ($toast)
    <script id="notifications">
        document.addEventListener('DOMContentLoaded', function () {
            const message = @json($toast['message']);
            const bgColor = @json($toast['color']);
            notify(message, '{{ $toast["type"] }}');
        });
    </script>
@endif
