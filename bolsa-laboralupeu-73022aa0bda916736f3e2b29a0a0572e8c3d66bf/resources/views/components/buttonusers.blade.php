<!-- resources/views/components/button.blade.php -->
@props(['href' => '#', 'color' => 'bg-green-500', 'hover' => 'hover:bg-green-600', 'icon' => '', 'counter' => 0])

<a href="{{ $href }}" class="relative {{ $color }} {{ $hover }} text-white font-bold py-2 px-4 rounded inline-flex items-center">
    @if($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}

    @if($counter > 0)
        <!-- Contador en la esquina superior derecha -->
        <span class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full">
            {{ $counter }}
        </span>
    @endif
</a>
