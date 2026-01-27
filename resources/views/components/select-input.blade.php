@props(['disabled' => false])

<select @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full rounded-md border-gray-400 shadow-sm focus:border-blue-600 focus:ring-blue-600 sm:text-sm py-2.5 px-3 text-gray-900']) }}>
    {{ $slot }}
</select>
