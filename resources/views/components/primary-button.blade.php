<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-orange-600 border border-transparent rounded-full font-semibold text-sm text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>
