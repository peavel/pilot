@extends('pilot::master')

@section('page_title', __('pilot::generic.media'))

@section('content')
    <div class="page-content container-fluid">
        @include('pilot::alerts')
        <div class="row">
            <div class="col-md-12">

                <div class="admin-section-title">
                    <h3><i class="pilot-images"></i> {{ __('pilot::generic.media') }}</h3>
                </div>
                <div class="clear"></div>
                <div id="filemanager">
                    <media-manager
                        base-path="{{ config('pilot.media.path', '/') }}"
                        :show-folders="{{ config('pilot.media.show_folders', true) ? 'true' : 'false' }}"
                        :allow-upload="{{ config('pilot.media.allow_upload', true) ? 'true' : 'false' }}"
                        :allow-move="{{ config('pilot.media.allow_move', true) ? 'true' : 'false' }}"
                        :allow-delete="{{ config('pilot.media.allow_delete', true) ? 'true' : 'false' }}"
                        :allow-create-folder="{{ config('pilot.media.allow_create_folder', true) ? 'true' : 'false' }}"
                        :allow-rename="{{ config('pilot.media.allow_rename', true) ? 'true' : 'false' }}"
                        :allow-crop="{{ config('pilot.media.allow_crop', true) ? 'true' : 'false' }}"
                        :details="{{ json_encode(['thumbnails' => config('pilot.media.thumbnails', []), 'watermark' => config('pilot.media.watermark', (object)[])]) }}"
                        ></media-manager>
                </div>
            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->
@stop

@section('javascript')
<script>
new Vue({
    el: '#filemanager'
});
</script>
@endsection
