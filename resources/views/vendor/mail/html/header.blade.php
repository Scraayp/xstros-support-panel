@props([
    'url',
])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block">
            @if (trim($slot) === 'Laravel')
                {{-- <img src="/no-bg-logo.png" class="logo" alt="Xstros Logo"> --}}
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
