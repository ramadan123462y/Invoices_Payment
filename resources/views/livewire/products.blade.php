<div>

    <div class="col">
        <label for="inputName" class="control-label">القسم</label>
        <select name="Section" wire:model='section_id' wire:click="get_products" class="form-control SlectBox"
            onclick="console.log($(this).val())" onchange="console.log('change is firing')">
            {{-- section_id
            products --}}
            {{-- sections------------- --}}
            @php
                $sections = \App\Models\Section::select('id', 'section_name')->get();
            @endphp
            {{-- end_sections------------- --}}

            <option selected disabled>حدد القسم</option>
            @foreach ($sections as $section)
                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col">
        <label for="inputName" class="control-label">المنتج</label>
        <select id="product" name="product" class="form-control">
            @foreach ($products as $product)
                <option value="{{ $product }}">{{ $product }}</option>
            @endforeach
        </select>
    </div>



</div>
