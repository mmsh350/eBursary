@props(['disabled' => false])

<select @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 py-2.5 px-3 text-gray-900 placeholder-gray-400 focus:border-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) }}>
    {{ $slot }}
</select>
