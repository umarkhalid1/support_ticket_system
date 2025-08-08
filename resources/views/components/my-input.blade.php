<div>
    <label class="mb-2 block font-medium text-gray-700" for="{{ $name }}">
        {{ $label }} <span class="text-red-600">*</span>
    </label>
    <input type="{{ $type }}" id="{{ $name }}" wire:model="{{ $model }}" class="form-input w-full" />
    @error($model)
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>
