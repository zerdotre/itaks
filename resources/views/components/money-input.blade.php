<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    {{-- <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}').defer }"></div> --}}
    <div wire:ignore>
        <input type="text" wire:model.defer="{{ $getStatePath() }}" x-mask:dynamic="moneyInput($input)">
    </div>
    {{-- <input wire:model.defer="{{ $getStatePath() }}" /> --}}
</x-dynamic-component>

<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
<script>
function moneyInput(input){
    var str = input.replace(/\D/g, "");
    var len = str.length;
    var str = new Array(len + 1).join('9');
    // return str.substring(0, -2) + ',' + str.substring(-2, len);
    return [str.slice(0, -2), ',', str.slice(-2)].join('');
}
</script>