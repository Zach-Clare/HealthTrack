<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <input name="first" placeholder="{{ __('First name') }}" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" value="{{ old('first') }}">
            <x-input-error :messages="$errors->get('message')" class="mt-2"/>
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        </form>

        <table class="mt-6 w-full bg-white shadow-sm rounded-lg table-fixed border border-slate-200">
            <thead>
                <th class="border">{{ __('Name') }}</th>
                <th class="border">{{ __('Added by') }}</th>
                <th class="border">{{ __('Created') }}</th>
                <th class="border">{{ __('Edited?') }}</th>
                <th></th>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td class="border">
                        {{$student->first}}
                    </td>
                    <td class="border">
                        {{$student->user->name}}
                    </td>
                    <td class="border">
                        {{ $student->created_at->format('j M Y, g:i a') }}
                    </td>
                    <td class="border">
                        @unless ($student->created_at->eq($student->updated_at))
                            {{ __("Edited") }}
                        @endunless
                    </td>
                    <td class="border">
                        @if ($student->user->is(auth()->user()))
                            <a href="{{ route('students.edit', $student)}}">{{ __('Edit') }}</a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('students.destroy', $student) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </a>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>

