<button class="btn btn-sm btn-primary mr-2" name="save-submit" value="save-submit" type="submit"><i class="fe fe-send"></i> Save & Submit</button>
<button class="btn btn-sm btn-secondary" name="draft" value="draft" type="submit"><i class="fe fe-save"></i>
    {{isset($application) ? 'Update Draft':'Save As Draft'}}
</button>
<a href="{{route('travel.index')}}" class="btn btn-sm btn-secondary cancel"><i class="fe fe-x-circle"></i> Cancel</a>
