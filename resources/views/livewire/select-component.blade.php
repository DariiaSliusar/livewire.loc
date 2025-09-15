<div class="mb-3">
    <div>
        <select id="country" class="form-select @error('form.country_id') is-invalid @enderror" wire:model.live="form.country_id">
            <option value="" selected>Select country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" wire:key="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    @error('form.country_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
</div>
