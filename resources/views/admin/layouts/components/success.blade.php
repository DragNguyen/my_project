@if (session()->get('success') != '')
    <div class="ui success message">
        <p>{{ session()->get('success') }}</p>
    </div>
@endif