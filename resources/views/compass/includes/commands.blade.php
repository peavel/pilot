@if($artisan_output)
    <pre>
        <i class="close-output pilot-x">{{ __('pilot::compass.commands.clear_output') }}</i><span class="art_out">{{ __('pilot::compass.commands.command_output') }}:</span>{{ trim(trim($artisan_output,'"')) }}
    </pre>
@endif

@foreach($commands as $command)
    <div class="command" data-command="{{ $command->name }}">
        <code>php artisan {{ $command->name }}</code>
        <small>{{ $command->description }}</small><i class="pilot-terminal"></i>
        <form action="{{ route('pilot.compass.post') }}" class="cmd_form" method="POST">
            {{ csrf_field() }}
            <input type="text" name="args" autofocus class="form-control" placeholder="{{ __('pilot::compass.commands.additional_args') }}">
            <input type="submit" class="btn btn-primary pull-right delete-confirm"
                    value="{{ __('pilot::compass.commands.run_command') }}">
            <input type="hidden" name="command" id="hidden_cmd" value="{{ $command->name }}">
        </form>
    </div>
@endforeach
