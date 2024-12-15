<div class="bg-gradient-to-r from-sky-800 to-sky-900 grid place-items-end border-t border-gray-200 rounded-b-lg">
    <button type="submit"
    class="py-4 px-6 text-white w-full md:w-80 font-semibold bg-sky-500 rounded-b-lg md:rounded-bl-none
    focus:ring focus:ring-sky-300
    hover:bg-sky-700 transition ease-in-out duration-200">
        <span wire:loading.delay.remove>{{ $button_text }}</span>
        <span wire:loading.delay>Laden...</span>
    </button>
</div>