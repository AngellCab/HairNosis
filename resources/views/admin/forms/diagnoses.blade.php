<div class="form-group">
    {!! Form::label('stylist_helpers', __('admin.stylist_helpers'), ['class' => 'form-label']) !!}
    {!! Form::select('stylist_helpers', [], null, ['class' => 'form-control select2', 'required', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('client_id', __('admin.client'), ['class' => 'form-address']) !!}
    {!! Form::select('client_id', null, ['class' => 'form-control select2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('apply_date', __('admin.phone'), ['class' => 'form-label']) !!}
    {!! Form::date('apply_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('diagnosis_type', __('admin.diagnosis_type'), ['class' => 'form-label']) !!}
    {!! Form::select('diagnosis_type', [], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('spa_visits', __('admin.spa_visits'), ['class' => 'form-label']) !!}
    {!! Form::select('spa_visits', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('versatility', __('admin.versatility'), ['class' => 'form-label']) !!}
    {!! Form::select('versatility', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('nails_feeling', __('admin.diagnosis_type'), ['class' => 'form-label']) !!}
    {!! Form::select('nails_feeling', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('nails_dislikes', __('admin.nails_dislikes'), ['class' => 'form-label']) !!}
    {!! Form::textArea('nails_dislikes', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('products_used', __('admin.products_used'), ['class' => 'form-label']) !!}
    {!! Form::textArea('products_used', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('nail_type', __('admin.nail_type'), ['class' => 'form-label']) !!}
    {!! Form::textArea('nail_type', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('final_diagnosis', __('admin.final_diagnosis'), ['class' => 'form-label']) !!}
    {!! Form::select('final_diagnosis', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('nail_type', __('admin.nail_type'), ['class' => 'form-label']) !!}
    {!! Form::textArea('nail_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Hair Diagnoses -->
<div class="form-group">
    {!! Form::label('personal_style', __('admin.personal_style'), ['class' => 'form-label']) !!}
    {!! Form::select('personal_style', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('professional_style', __('admin.professional_style'), ['class' => 'form-label']) !!}
    {!! Form::select('professional_style', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('personal_interestings', __('admin.personal_interestings'), ['class' => 'form-label']) !!}
    {!! Form::textArea('personal_interestings', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_goals', __('admin.hair_goals'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_goals', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('salon_visits', __('admin.salon_visits'), ['class' => 'form-label']) !!}
    {!! Form::select('salon_visits', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hairstyle_time', __('admin.hairstyle_time'), ['class' => 'form-label']) !!}
    {!! Form::select('hairstyle_time', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_versatility', __('admin.hair_versatility'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_versatility', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('how_hairstyle', __('admin.how_hairstyle'), ['class' => 'form-label']) !!}
    {!! Form::select('how_hairstyle', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_comfort', __('admin.hair_comfort'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_comfort', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_likes_dislikes', __('admin.hair_likes_dislikes'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_likes_dislikes', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_products_used', __('admin.hair_products_used'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_products_used', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_abundance', __('admin.hair_abundance'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_abundance', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('diameter', __('admin.diameter'), ['class' => 'form-label']) !!}
    {!! Form::select('diameter', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('hair_shape', __('admin.hair_shape'), ['class' => 'form-label']) !!}
    {!! Form::select('hair_shape', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('condition', __('admin.condition'), ['class' => 'form-label']) !!}
    {!! Form::select('condition', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('damage_type', __('admin.damage_type'), ['class' => 'form-label']) !!}
    {!! Form::select('damage_type', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('face_type', __('admin.face_type'), ['class' => 'form-label']) !!}
    {!! Form::select('face_type', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('skin_tone', __('admin.skin_tone'), ['class' => 'form-label']) !!}
    {!! Form::select('skin_tone', [], null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('previous_chemical_services', __('admin.previous_chemical_services'), ['class' => 'form-label']) !!}
    {!! Form::select('previous_chemical_services', [], null, ['class' => 'form-control select2']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>