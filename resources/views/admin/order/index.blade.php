@extends('admin.master')

@section('title', 'Đơn hàng')

@section('nav_title', 'Đơn hàng')

@section('content')
    <form>
        <p>
            <label>
                <input type="checkbox" class="filled-in" checked="checked" id="checkAll" onclick="eventCheckBox()"/>
                <span>Filled in</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" class="filled-in" checked="checked" />
                <span>Filled in</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" class="filled-in" checked="checked" />
                <span>Filled in</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" class="filled-in" checked="checked" />
                <span>Filled in</span>
            </label>
        </p>
        <p>
            <label>
                <input type="checkbox" class="filled-in" checked="checked" />
                <span>Filled in</span>
            </label>
        </p>
    </form>




    @include('admin.layouts.components.action')
@endsection
@push('scripts')
    @stack('scripts')
    <script>

        function eventCheckBox() {
            let checkboxs = document.getElementsByTagName("input");
            for(let i = 1; i < checkboxs.length ; i++) {

                checkboxs[i].checked = checkboxs[0].checked;
            }
        }
    </script>
    @endpush