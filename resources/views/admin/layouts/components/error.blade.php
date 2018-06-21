@if (session()->get('error') != '')

    <div class="ui label error-message notification-message">
        <i class="cancel icon"></i>
        {{ session()->get('error') }}
    </div>
@endif