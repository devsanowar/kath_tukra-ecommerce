<tr>
    <td class="header" style="text-align: center;">
        <a href="{{ route('home') }}">
            @if (config('app.website_logo'))
                <img src="{{ asset(config('app.website_logo')) }}" alt="{{ config('app.name') }}" width="200">
            @else
                {{ config('app.website_title', config('app.name')) }}
            @endif
        </a>
    </td>
</tr>
