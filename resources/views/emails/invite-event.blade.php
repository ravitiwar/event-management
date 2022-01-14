@component('mail::message')
# We’d love to see you among us at ({{$title}})

{{$description}}

Place: {{$place}}

Thanks,<br>
    {{ config('app.name') }}
@endcomponent
