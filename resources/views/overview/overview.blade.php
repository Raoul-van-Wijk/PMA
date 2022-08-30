<x-app-layout>
    <x-slot name="header">
        {{ __('Overview') }}
    </x-slot>

    <thead>
        <tr>
            <th>{{ __('Week 1') }}</th>
            <th>{{ __('Week 2') }}</th>
            <th>{{ __('Week 3') }}</th>
            <th>{{ __('Week 4') }}</th>
            <th>{{ __('Week 5') }}</th>
            <th>{{ __('Week 6') }}</th>
            <th>{{ __('Week 7') }}</th>
            <th>{{ __('Week 8') }}</th>
            <th>{{ __('Week 9') }}</th>
            <th>{{ __('Week 10') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $overview->week1 }}</td>
            <td>{{ $overview->week2 }}</td>
            <td>{{ $overview->week3 }}</td>
            <td>{{ $overview->week4 }}</td>
            <td>{{ $overview->week5 }}</td>
            <td>{{ $overview->week6 }}</td>
            <td>{{ $overview->week7 }}</td>
            <td>{{ $overview->week8 }}</td>
            <td>{{ $overview->week9 }}</td>
            <td>{{ $overview->week10 }}</td>
        </tr>
    </tbody>
</x-app-layout>
