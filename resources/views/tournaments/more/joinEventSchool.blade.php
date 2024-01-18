@if(auth()->check())
    @include('layouts.navigation')
@else
    @include('layouts.navigationNU')
@endif

<x-guest-layout>
   bbb
</x-guest-layout>
