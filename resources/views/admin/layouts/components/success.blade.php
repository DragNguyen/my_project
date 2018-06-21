@if (session()->get('success') != '')

    <div class="ui label success-message notification-message">
        <i class="check icon"></i>
        {{ session()->get('success') }}
    </div>
@endif